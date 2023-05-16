<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(3);

        return view('admin-panel.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin-panel.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp,svg',
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $image = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images/', $image);

        Project::create([
            'image' => $image,
            'name' => $request->name,
            'url' => $request->url,
        ]);
        return redirect()->route('projects.index')->with('successMsg', 'Successfully created a project!');
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
        $project = Project::find($id);

        return view('admin-panel.projects.edit', compact('project'));
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
        $request->validate([
            'image' => 'file|image|mimes:jpg,jpeg,png,svg,webp',
            'name' => 'required',
            'url' => 'required|url',
        ]);

        $project = Project::find($id);

        if ($request->hasFile('image')) {
            $oldImage = $project->image;
            Storage::delete('public/images/' . $oldImage);

            $newImage = uniqid() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/images/', $newImage);

            $project->update([
                'image' => $newImage,
            ]);
        }

        $project->update([
            'name' => $request->name,
            'url' => $request->url,
        ]);

        return redirect()->route('projects.index')->with('successMsg', 'Successfully updated a project!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::find($id)->delete();
        return back()->with('successMsg', 'Successfully deleted a project');
    }
}
