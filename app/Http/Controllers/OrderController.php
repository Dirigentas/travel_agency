<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user_role = Auth::user()->role;

        if ($user_role == 'administratorius')
        {
            $orders = Order::all()
            ->map(function($order) {
                $order->hotels = json_decode($order->order_json);
                return $order;
            });
            return view('back.orders.index', [
                'orders' => $orders,
            ]);
            
        } else {
            $orders = Order::where('user_id', $user_id)->get()
            ->map(function($order) {
                $order->hotels = json_decode($order->order_json);
                return $order;
            });
            return view('front.orders', [
                'orders' => $orders,
                'country' => 'no'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status = 1;

        $order->save();

        return redirect()->back()->with('ok', 'Rezervacija patvirtinta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->back()->with('ok', 'Rezervacija ištrinta sėkmingai');
    }
}