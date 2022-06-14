<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Tag;
use Inertia\Inertia;

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

        return Inertia::render('Admin/Blog', [
            'blogs' => $blogs,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $blog = Blog::create([
            'title' => $request -> title,
            'image' => $filename,
            'text' => $request -> text,
            'tag_id' => $request -> tag_id,
        ]);

        return redirect()->back();
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
        $request -> validate([
            'title' => 'nullable',
            'text' => 'nullable',
            'tag_id' => 'nullable',
        ]);

        $blog = Blog::find($id);

        $blog -> update($request -> only('title' ,  'text', 'tag_id'));

        return $blog;
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

        return redirect()->back();
    }
}
