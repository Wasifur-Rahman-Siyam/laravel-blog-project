<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\UploadHelper;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\New_;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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
            'name'          => 'required|max:60|unique:categories',
            'image'         => 'required|image|mimes:jpg,png,jpeg,gif,svg'
        ],[
            'name.required'         => 'The Category name field is required.'
        ]);
        $Category = new Category();
        $Category->name  =   $request->name;
        $Category->slug  =   Str::slug($request->name);
        $Category->save();
        $image= $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $fileName = $Category->slug.'-'.$Category->id.'.'.$extension;
            if (!file_exists('images/categories/banner/')) {
                mkdir('images/categories/banner/', 666, true);
            }
            $path = 'images/categories/banner/' . $fileName;
            Image::make($image)->resize(1600,479)->save($path);
            if (!file_exists('images/categories/card/')) {
                mkdir('images/categories/card/', 666, true);
            }
            $path = 'images/categories/card/' . $fileName;
            Image::make($image)->resize(353,253)->save($path);
            $Category->image = $fileName;
            $Category->save();
        }
        return redirect()->back()->with('msg', 'Category Added Successfully');
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
        $Category = Category::find($id);
        return view('backend.category.edit',compact('Category'));
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
