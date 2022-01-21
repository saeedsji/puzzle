<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::filter()->orderBy('sort')->get();
        $tree = Category::where('parent_id', 0)->orderBy('sort')->get();
        $count = Category::filter()->count();
        $parent_id = request('parent_id');
        $parent = !empty($parent_id) ? Category::find($parent_id) : null;
        return view('admin.category.index', compact('categories', 'count', 'tree','parent'));
    }
    
    public function create()
    {
        $categories = Category::root()->sort()->get();
        $default_parent_id = !empty(request('parent_id')) ? request('parent_id') : 0;
        return view('admin.category.create', compact('categories','default_parent_id'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'sort' => 'required|numeric',
            'status' => 'required',
            'parent_id' => 'required',
            'image' => 'nullable',
        ]);
        $category = Category::create($validatedData);
        alert()->success('عملیات موفق', 'مورد جدید با موفقیت ثبت شد');
        return redirect(route('category.index'));
    }
    
    public function edit(Category $category)
    {
        $categories = Category::root()->sort()->get();
        return view('admin.category.edit', compact('category','categories'));
    }
    
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'sort' => 'required|numeric',
            'status' => 'required',
            'parent_id' => 'required',
            'image' => 'nullable',

        ]);
        $category->update($validatedData);
        alert()->success('عملیات موفق', 'بروزرسانی با موفقیت انجام شد');
        return redirect(route('category.index'));
    }
    
    public function destroy(Category $category)
    {
        
        foreach ($category->childs as $child)
        {
            foreach ($child->childs as $child_child)
            {
                $child_child->delete();
            }
            $child->delete();
        }
        
        $category->delete();
        toast('آیتم مورد نظر با موفقیت حذف شد', 'success')->timerProgressBar();
        return back();
    }
}
