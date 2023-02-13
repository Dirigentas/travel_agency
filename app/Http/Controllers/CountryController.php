<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Hotel;
use Illuminate\Http\Request;

class countryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Country $countries)
    {
        $countries = $countries->get(); //duomenu gavimas
        
        return view('back.countries.index', [
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = new Country;
        $country->name = $request->name;
        $country->season_start = $request->season_start;
        $country->season_end = $request->season_end;
        $country->save();

        return redirect()->back()->with('ok', 'Šalis pridėta sėkmingai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(country $country)
    {
        return view('back.countries.edit', [
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, country $country)
    {
        $country->name = $request->name;
        $country->season_start = $request->season_start;
        $country->season_end = $request->season_end;
        $country->save();

        return redirect()->back()->with('ok', 'Šalis atnaujinta sėkmingai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)   
    {
        if (!$country->countryHotels()->count()) {
            $country->delete();
            return redirect()->back()->with('ok', 'Šalis ištrinta sėkmingai');
        }

        return redirect()->back()->with('not', 'Šalis turi susietų viešbučių');
    }
}
