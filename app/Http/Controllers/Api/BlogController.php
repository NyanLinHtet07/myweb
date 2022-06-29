<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tag;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        $tags = Tag::all();

        foreach ( $blogs as $blog){
            $blog -> tag_id = json_decode($blog -> tag_id);
        }

        return response() -> json(['blogs' => $blogs , 'tags' => $tags]);
    }


    public function store(Request $request)
    {
        $request -> validate([
            'title' => 'required',
            'image' => 'nullable',
            'text' => 'nullable',
            'tag_id' => 'required',
        ]);

        if($request -> hasFile('image')){
            $file = $request -> file('image');
            $filename = uniqid().'_'.$file -> getClientOriginalName();
            $file -> move(public_path().'upload/blog/', $filename);
        }
        else{
            $filename = null;
        } 

        //foreach(json_decode($request -> tag_id , true) as $tag)

        $blog = Blog::create([
            'title' => $request -> title,
            'image' => $filename,
            'text' => $request -> text,
            'tag_id' => $request -> tag_id,
        ]);

        return $blog;

        //return response() => json(['message' => 'success']);
    }


    public function show($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        $request -> validate([
            'title' => 'nullable',
            'text' => 'nullable',
            'tag_id' => 'nullable',
        ]);

        $blog = Blog::find($id);

        $blog -> update($request -> only('title' ,  'text', 'tag_id'));

        return $blog;

        //return response() => json(['message' => 'successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        $blog -> delete();

        return $blog;

        //return response() => json(['message' => 'data destroyed']);
    }
}
