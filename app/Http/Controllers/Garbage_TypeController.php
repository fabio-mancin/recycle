<?php

namespace App\Http\Controllers;

use App\Models\Garbage_Type;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class Garbage_TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $garbage_types = Garbage_Type::all();

        return view('garbageindex', compact('garbage_types'));
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
            "Glass", "Plastic", "Organic", "Metal", "Paper", "Batteries"
        ];

        //getting all the types in the DB
        $existing_types = Garbage_Type::all()->toArray();
        //if there are some..
        if (count($existing_types)>0) {
            //..then group them by type..
            $existing_types = array_merge_recursive ( ...$existing_types )['type'];
        } else {
            //..if there are none, prevent an error and use an empty array
            $existing_types = [];
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
                $new_element = new Garbage_Type();
                $new_element->type = $element;
                if (!Garbage_Type::select("*")
                      ->where("type", strtolower($element))
                      ->exists()) {                
                    $new_element->save();
                } else {
                    throw ValidationException::withMessages(['Error!' => "That type already exists."]);
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
        //try to update the DB with the selected name
        if (Garbage_Type::where('type', $request->garbage_type)->exists()) {
            //throw an error if the name already exists
            throw ValidationException::withMessages(['Error!' => "You cannot choose a name that already exists for your garbage types."]);
        } else {
            //update the item if it doesn't
            Garbage_Type::findOrFail($id)->update(['type' => strtolower($request->garbage_type)]);
            return redirect('/garbage_type');
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
        $garbage_type = Garbage_Type::findOrFail($id);
        $garbage_type->delete();
        
        return redirect('/garbage_type');
    }
}
