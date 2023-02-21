<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IdeaCategory;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCategory()
    {
        $categories = Category::all()->where('is_deleted', false);
        return view ('categories.show-create', compact('categories'));
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
    public function addCategory(Request $request)
    {

        $request->validate([
            'name' => 'required|min:2|max:30|unique:categories,name'
        ]);

        Category::create($request->post());

        return redirect('category')->with('success','Category has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function editCategory(string $id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, string $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|min:2|max:30|unique:categories',
            'updated_at' => now()
        ]);

        $category->fill($request->post())->save();

        $input = $request->all();
        $category->update($input);
        return redirect('category')->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory(Request $request, string $id)
    {
        $list = IdeaCategory::find($id, ['category_id']);
        
        
        if($list = true)
        {
            Category::find($id)->update(array('is_deleted' => true));

            return redirect('category')->with('success', 'Category deleted successfully.');
        }
        else
        {
            return redirect('category')->with('failure', 'Cannot delete. Category is currently in use.');
        }
    }
}
