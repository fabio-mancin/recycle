<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Day;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $standard_days = [
            "monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"
        ];

        $existing_days = Day::all();
        $existing_days_array = $existing_days->toArray();
        if (count($existing_days_array)>0) {
            $existing_names = array_merge_recursive ( ...$existing_days_array )['name'];
        } else {
            $existing_days_array = [];
            $existing_names = [];
        }
        
        return view('createdays', compact('standard_days', 'existing_names', 'existing_days'));
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
        ])['days'];
        
        foreach ($days as $day) {
            
            $new_day = new Day;
            $new_day->name = $day;
            $new_day->number_in_week = date('N', strtotime($day));
            if (!Day::select("*") 
                      ->where("name", $day)
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
        $day = Day::findOrFail($id);
        $day->delete();

        return redirect('/days/create');
    }
}
