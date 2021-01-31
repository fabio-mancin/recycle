<?php

namespace App\Http\Controllers;

use App\Models\Garbage_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Garbage_TypeController extends Controller
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
        return view('creategarbage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        function recursive_add($array) {
            $array = array_filter($array);
            foreach ($array as $element) {
                //Log::channel('stderr')->info($element);
                if (!empty($element) && str_contains($element, ',')) {
                    $type_arr = explode(",", $element);
                    recursive_add($type_arr);
                    continue;
                }
                $new_element = new Garbage_Type();
                $new_element->type = $element;
                if (!Garbage_Type::select("*")
                      ->where("type", $element)
                      ->exists()) {                
                $new_element->save();
                }
            };
        };

        $types = $request->validate([
            "garbage_types" => "array|min:1"
        ]);
        
        recursive_add($types["garbage_types"]);
        
        return redirect('/collections/create');
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
