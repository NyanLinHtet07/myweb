<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $tags = Tag::all();
        $projects = Project::all(); 

        foreach( $projects as $project){
            $project -> image = json_decode($project -> image);
        }

        return response() -> json(['tags' => $tags , 'projects' => $projects]);
    }

   
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

        else{
            $result = null;
        }

        $project = Project::create([
            'title' => $request->title,
            'image'=> $result,
            'url' => $request -> url,
            'description' => $request -> description,
            'tag_id' => $request -> tag_id,
        ]);

        return $project;
    }

    
    public function show($id)
    {
       
    }

   
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

   
    public function destroy($id)
    {
        $project -> Project::find($id);
        $project -> delete();

        return $project;
    }
}
