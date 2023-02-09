<?php

namespace App\Http\Controllers;

use App\Models\Front;
use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;

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
        
         $hotels =$hotels->get(); //duomenu gavimas

        return view('front.home', [
            'hotels' => $hotels,
            'sortSelect' => Hotel::SORT,
            'sortShow' => isset(Hotel::SORT[$request->sort]) ? $request->sort : '',
            's' => $request->s ?? '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        return view('front.hotel', [
            'hotel' => $hotel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function edit(Front $front)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Front $front)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Front  $front
     * @return \Illuminate\Http\Response
     */
    public function destroy(Front $front)
    {
        //
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
        ]);
    }
}
