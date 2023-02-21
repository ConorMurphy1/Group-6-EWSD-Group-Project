<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IdeaCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCategory()
    {
        $categories = Category::all();

        return view ('categories.show-create', compact('categories'));
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
            'name' => 'required|min:2|max:30'
        ]);

        Category::create($request->post());

        return redirect('category')->with('success','Category has been created successfully.');
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

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
            $category = Category::find($id);
            $category->delete();

            return redirect('category')->with('success', 'Category deleted successfully.');
        }
        else
        {
            return redirect('category')->with('failure', 'Cannot delete. Category is currently in use.');
        }
    }
}
