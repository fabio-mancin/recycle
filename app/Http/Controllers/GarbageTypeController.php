<?php

namespace App\Http\Controllers;

use App\Models\GarbageType;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class GarbageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $garbagetypes = GarbageType::all();

        return view('garbageindex', compact('garbagetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //adding a "disabled" property to the standard elements already added to the DB
        $standard_types = [
            "glass", "plastic", "organic", "metal", "paper", "batteries"
        ];

        //getting all the types in the DB
        $existing_types = GarbageType::all()->toArray();
        //if there are some..
        if (count($existing_types)>0) {
            //..then group them by type..
            $existing_types = array_merge_recursive ( ...$existing_types )['type'];
        } else {
            //..if there are none, prevent an error and use an empty array
            $existing_types = [];
        }

        if (is_string($existing_types)) {
            $existing_types = [$existing_types];
        }

        //the difference is parsed in the view itself
        return view('creategarbage', compact('standard_types', 'existing_types'));
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
                if (!empty($element) && str_contains($element, ',')) {
                    $type_arr = explode(",", $element);
                    recursive_add($type_arr);
                    continue;
                }
                $new_element = new GarbageType();
                $new_element->type = $element;
                if (!GarbageType::select("*")
                      ->where("type", strtolower($element))
                      ->exists()) {                
                    $new_element->save();
                } else {
                    throw ValidationException::withMessages(['Error!' => "That type already exists."]);
                }
            };
        };

        $types = $request->validate([
            "garbagetypes" => "array|min:1"
        ]);
        
        recursive_add($types["garbagetypes"]);
        
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
        //try to update the DB with the selected name
        if (GarbageType::where('type', $request->garbagetype)->exists()) {
            //throw an error if the name already exists
            throw ValidationException::withMessages(['Error!' => "You cannot choose a name that already exists for your garbage types."]);
        } else {
            //update the item if it doesn't
            GarbageType::findOrFail($id)->update(['type' => strtolower($request->garbagetype)]);
            return redirect('/garbagetype');
        }     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //just destroying the selected element
        $garbagetype = GarbageType::findOrFail($id);
        $garbagetype->delete();
        
        return redirect('/garbagetype');
    }
}
