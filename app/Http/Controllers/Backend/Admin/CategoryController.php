<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\File; 
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
        return view('backend.admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.category.create');
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
        $category = Category::find($id);
        return view('backend.admin.category.edit',compact('category'));
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
        $category = Category::find($id);
        $request->validate([
            'name'          => 'required|max:60|unique:categories,name,'.$category->id,
            'image'         => 'image|mimes:jpg,png,jpeg,gif,svg'
        ],[
            'name.required'         => 'The Category name field is required.'
        ]);
        $category->name  =   $request->name;
        $category->slug  =   Str::slug($request->name);
        $category->save();
        $image= $request->image;
        if($image){
            $extension = $image->getClientOriginalExtension();
            $fileName = $category->slug.'-'.$category->id.'.'.$extension;

            $deleteImage = 'images/categories/banner/'.$category->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
            if (!file_exists('images/categories/banner/')) {
                mkdir('images/categories/banner/', 666, true);
            }
            $path = 'images/categories/banner/' . $fileName;
            Image::make($image)->resize(1600,479)->save($path);

            $deleteImage = 'images/categories/card/'.$category->image;
            if(File::exists($deleteImage)){
               File::delete($deleteImage);
            }
            if (!file_exists('images/categories/card/')) {
                mkdir('images/categories/card/', 666, true);
            }
            $path = 'images/categories/card/' . $fileName;
            Image::make($image)->resize(353,253)->save($path);
            $category->image = $fileName;
            $category->save();
        }
        return redirect()->back()->with('msg', 'Category Added Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $deleteImage1 = 'images/categories/banner/'.$category->image;
        $deleteImage2 = 'images/categories/card/'.$category->image;
        $category ->delete();

        if(File::exists($deleteImage1)){
            File::delete($deleteImage1);
        }
        if(File::exists($deleteImage2)){
            File::delete($deleteImage2);
        }
        
        return redirect()->back()->with('msg', 'Tag Deleted Successfully');
    }
}
