<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Country;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Hotel $hotels)
    {
        $hotels = $hotels->get(); //duomenu gavimas
        
        return view('back.hotels.index', [
            'hotels' => $hotels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all()->sortBy('country');
        
        return view('back.hotels.create', [
            'countries' => $countries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = new Hotel;

        if ($request->file('photo')) {
            $photo = $request->file('photo');
            
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // Intervention library nauojimas paveiksleliu apkirpimui
            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 200);
            $image->save(public_path().'/hotels/'.$file);

            // $photo->move(public_path().'/hotels', $file); // serveryje is TEMP dir perkeliama i normalia dir. Irasom i serveri su publick_path

            $hotel->photo = '/hotels/'. $file; // issaugojimas i DB. O skaitom su Asset (kelias narsyklei)
        }

        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->trip_length = $request->trip_length;
        $hotel->country = $request->country;
        $hotel->save();

        return redirect()->back()->with('ok', 'Viešbutis pridėtas sėkmingai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        $countries = Country::all()->sortBy('country');

        return view('back.hotels.edit', [
            'hotel' => $hotel,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        // 'Istrinti nuotrauka' mygtuko paspaudimas
        if ($request->delete_photo) {
            $hotel->deletePhoto();
            return redirect()->back();
        }

        // vykdosi jei buvo uzkelta nauja nuotrauka
        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // Intervention library nauojimas paveiksleliu apkirpimui
            $manager = new ImageManager(['driver' => 'GD']);
            $image = $manager->make($photo);
            $image->crop(400, 200);
            $image->save(public_path().'/hotels/'.$file);            
            
            // kadangi buvo uzkelta nauja nuotrauka, senaja reikia istrinti
            if ($hotel->photo) {
                $hotel->deletePhoto();
            }
            
            // $photo->move(public_path().'/hotels', $file);
            $hotel->photo = '/hotels/'. $file; // issaugojimas i DB. O skaitom su Asset (kelias narsyklei)
        }

        $hotel->name = $request->name;
        $hotel->price = $request->price;
        $hotel->trip_length = $request->trip_length;
        $hotel->country = $request->country;
        $hotel->save();

        return redirect()->back()->with('ok', 'Viešbutis atnaujintas sėkmingai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->deletePhoto();
        $hotel->delete();
        

        return redirect()->back()->with('ok', 'Viešbutis ištrintas sėkmingai');
    }
}
