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
            $collection->day = ucfirst(DB::table('days')->where('id', $collection->days_id)->value('name'));
            $collection->number_in_week = DB::table('days')->where('id', $collection->days_id)->value('number_in_week');
            $collection->type = ucfirst(DB::table('garbage__types')->where('id', $collection->garbage_id)->value('type'));   
            //clock()->info($collection);
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
        $types = DB::table('garbage__types')->get();
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
            $new_collection = new Collection;       
            $new_collection->garbage_id = $collection[0];   
            $new_collection->days_id = $collection[1];
            $new_collection->time = $collection[2];
            $day = ucfirst(DB::table('days')->where('id', $collection[0])->value('name'));

            if (!Collection::select("*")
                ->where("days_id", "=", $collection[0])
                ->where("time", "=", $collection[2])
                ->exists()) {
                    $new_collection->save();
                } else {
                    throw ValidationException::withMessages(['Error!' => 
                        "A collection already exists on {$day} at {$collection[2]}."]);
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
