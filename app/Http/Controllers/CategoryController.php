<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IdeaCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        
        return view ('categories.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $category = new Category();
        return view('categories.create-edit', compact('category'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|min:2|max:20',
        ]);

        Category::create($data);

        Alert::toast('Category created successfully', 'success');

        return redirect('categories')->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.create-edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        $data = $request ->validate([
            'name' => 'required|min:2|max:20',
            'updated_at' => now()
        ]);

        $category->update($data);

        Alert::toast('Category updated successfully', 'success');

        return redirect('categories')->with('success', 'Category Updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, string $id)
    {
        $list = IdeaCategory::where('category_id',$id)->first();
        
        if(is_null($list))
        {
            $category = Category::find($id);
            $category->delete();

            Alert::toast('Category deleted successfully', 'success');

            return redirect('categories')->with('success', 'Category deleted successfully.');
            
        }
        else
        {
            Alert::toast('Cannot delete. Category is currently in use.', 'error');

            return redirect('categories')->with('failure', 'Cannot delete. Category is currently in use.');
        }
    }
}
