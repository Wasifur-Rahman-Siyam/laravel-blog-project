<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::latest()->get();
        return view('backend.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tag.create');
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
            'name'          => 'required|max:60|unique:tags',
        ],[
            'name.required'         => 'The Tag name field is required.'
        ]);
        $tag = new Tag();
        $tag->name  =   $request->name;
        $tag->slug  =   Str::slug($request->name);
        $tag->save();
        
        return redirect()->back()->with('msg', 'Tag Added Successfully');

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
        $tag = Tag::Find($id);
        return view('backend.tag.edit', compact('tag'));
        
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
        $tag = Tag::find($id);
        $request->validate([
            'name'          => 'required|max:60|unique:tags,name,'.$tag->id,
        ],[
            'name.required'         => 'The Tag name field is required.'
        ]);
        $tag = Tag::Find($id);
        $tag->name  =   $request->name;
        $tag->slug  =   Str::slug($request->name);
        $tag->save();
        
        return redirect()->route('admin.tag.index')->with('msg', 'Tag Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::Find($id);
        $tag ->delete();
        return redirect()->back()->with('msg', 'Tag Deleted Successfully');
    }
}
