<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class CategoriesController extends Controller
{
    public function  index()
    {
        $categories = Category::all();

        return view('categories/list-categories')->with('categories', $categories);
    }

    public function create()
    {
        return view('categories/create-category');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2'
        ]);

        Category::create([
            'title' => $request->title
        ]);

        return redirect(route('categories'));
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories/create-category')->with('category', $category);
    }

    public function delete($id)
    {
        $category = Category::find($id);

         foreach ($category->materials as $item)
        {
            $item->delete();            
        }
        $category->delete();

        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:2'
        ]);

        $category = Category::find($id);

        $category->update([
            'title' => $request->title
        ]);

        return redirect(route('categories'));
    }
}
