<?php

namespace App\Http\Controllers;

use App\Models\Front;
use App\Models\Hotel;
use App\Models\Country;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Hotel $hotels, Request $request)
    {
        if ($request->s)
        {
            $s = explode(' ', $request->s);
            
            //vieno zodzio paieska
            if(count($s) == 1) {
                $hotels = Hotel::where('name', 'like', '%'.$s[0].'%');
            }
            //dvieju zodziu paieska
            else {
                $hotels = Hotel::where('name', 'like', '%'.$s[0].'%'.$s[1].'%')->orWhere('name', 'like', '%'.$s[1].'%'.$s[0].'%');
            }
        } else {
            $hotels = Hotel::where('id', '>', 0);
        }

        $hotels = match($request->sort ?? '') {
            'asc_price' => $hotels->orderBy('price'),
            'desc_price' => $hotels->orderBy('price', 'desc'),
            default => $hotels
        };
        
         $hotels = $hotels->get(); //duomenu gavimas

        return view('front.home', [
            'hotels' => $hotels,
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            's' => $request->s ?? '',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        $user = Auth::user();
        
        return view('front.hotel', [
            'hotel' => $hotel,
            'user' => $user
        ]);
    }

    public function showCatHotels($country, Request $request)
    {
        $hotels = Hotel::where('country', $country);

        if ($request->s)
        {
            $s = explode(' ', $request->s);
            
            //vieno zodzio paieska
            if(count($s) == 1) {
                $hotels = $hotels->where('name', 'like', '%'.$s[0].'%');
            }
            //dvieju zodziu paieska
            else {
                $hotels = $hotels->where('name', 'like', '%'.$s[0].'%'.$s[1].'%')->orWhere('name', 'like', '%'.$s[1].'%'.$s[0].'%');
            }
        }

        $hotels = match($request->sort ?? '') {
            'asc_price' => $hotels->orderBy('price'),
            'desc_price' => $hotels->orderBy('price', 'desc'),
            default => $hotels
        };

        $hotels =$hotels->get(); 

        return view('front.home', [
            'hotels' => $hotels,
            's' => $request->s ?? '',
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            'country' => $country,
        ]);
    }

    public function addToCart(Request $request, CartService $cart)
    {
        $id = (int) $request->hotel;
        $count = (int) $request->count;
        $cart->add($id, $count);

        return redirect()->back()->with('ok', 'Kelionė pridėta į krepšelį');
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list,
            'country' => 'no'
        ]);
    }

    public function updateCart(Request $request, CartService $cart)
    {
       
        if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back()->with('ok', 'Krepšelis atnaujintas sėkmingai');
    }

    public function makeOrder(CartService $cart)
    {
        $order = new Order;

        $order->user_id = Auth::user()->id;

        $order->order_json = json_encode($cart->order());

        $order->save();

        $cart->empty();

        return redirect()->route('index')->with('ok', 'Rezervacija atlikta');
    }
}
