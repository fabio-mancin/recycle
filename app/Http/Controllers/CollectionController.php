<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collections = Collection::all();

        foreach ($collections as $collection) {
            $collection->day = ucfirst(DB::table('days')->where('id', $collection->day_id)->value('name'));
            $collection->number_in_week = DB::table('days')->where('id', $collection->day_id)->value('number_in_week');
            $collection->type = ucfirst(DB::table('garbagetypes')->where('id', $collection->garbagetype_id)->value('type'));   
        }

        $collections = $collections->sortBy('number_in_week');

        return view('index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = DB::table('garbagetypes')->get();
        $days = DB::table('days')->get();

        return view('createcollections', ['types' => $types,
                                         'days' => $days]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        function saveCollection($collection) {
            $garbagetype_id = $collection[0]; 
            $day_id = $collection[1];
            $collection_time = $collection[2];
            $new_collection = new Collection;       
            $new_collection->garbagetype_id = $garbagetype_id;   
            $new_collection->day_id = $day_id;
            $new_collection->time = $collection_time;
            $day = ucfirst(DB::table('days')->where('id', $day_id)->value('name'));

            if (!Collection::select("*")
                ->where("day_id", $day_id)
                ->where("time", $collection_time)
                ->exists()) {
                    $new_collection->save();
                } else {
                    throw ValidationException::withMessages(['Error!' => 
                        "A collection already exists on {$day} at {$collection_time}."]);
                }        
        }

        $collections = $request->validate([
            "collections" => "required|array|min:1"
        ])["collections"];

        if (count($collections)>3){
            $collections = array_chunk($collections, 3);
            foreach ($collections as $collection) {
                saveCollection($collection);
            }   
            return redirect('index');
        } 

        saveCollection($collections);

        return redirect('index');
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
        $collection = Collection::findOrFail($id);
        $collection->delete();

        return redirect('/collections');
    }
}
