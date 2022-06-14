<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Project');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'url' => 'nullable',
            'description' => 'nullable',
            'tag_id' => 'required',
        ]);

        if($request -> hasfile('image')){
            $data = [];

            foreach($request -> file('image') as $file){
                $name = Uniqid().'_'.$file -> getClientOriginalName();
                $file -> move(public_path().'/upload/project/', $name);
                $data[] = $name;
                $result = json_encode($data);
            }
        }

        $project = Project::create([
            'title' => $request->title,
            'image'=> $result,
            'url' => $request -> url,
            'description' => $request -> description,
            'tag_id' => $request -> tag_id,
        ]);

        return redirect()-> back();
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
        $request -> validate ([
            'title' => 'nullable',
            'url' => 'nullable',
            'description' => 'nullable',
        ]);

        $project = Project::find($id);

        $project -> update( $request -> only('title','url', 'description'));

        return $project;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project -> Project::find($id);
        $project -> delete();

        return redirect()->back();
    }
}
