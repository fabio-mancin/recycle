<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Day;
use Illuminate\Support\Facades\Log;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$days = Day::all()->sortBy('number_in_week');
        return view('index', compact('days'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createdays');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $days = $request->validate([
            "days" => "required|array|min:1"
        ]);
        foreach ($days["days"] as $day) {
            $day = explode("-", $day);
            $new_day = new Day;
            $new_day->name = $day[1];
            $new_day->number_in_week = $day[0];
            if (!Day::select("*")
                      ->where("name", $day[1])
                      ->exists()) {
                $new_day->save();
            }    
        }

        return redirect('/garbage_type/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
