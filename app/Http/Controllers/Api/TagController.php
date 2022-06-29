<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
   
    public function index() 
    {
        $tag = Tag::all();

        return response() -> json(['tag' => $tag]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'icon' => 'nullable',
        ]);

       if($request -> hasFile('icon')){
           $file = $request -> file('icon');
           $filename = uniqid().'_'.$file -> getClientOriginalName();
           $file -> move(public_path().'/upload/tag/', $filename);
       }

       else {
        $filename = null;
       }

       $tag = Tag::create([
           'name' => $request -> name,
           'icon' => $filename,
       ]);

       return $tag;
    }

   
    public function show($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        $request -> validate ([
            'name' => 'nullable',
        ]);

        $tag = Tag::find($id);
        $tag-> update( $request -> only('name'));

        return $tag;
    }

   
    public function destroy($id)
    {
        
        $tag = Tag::find($id);
        $tag -> delete();
        return $tag;
    }
}
