<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Link;
use App\Models\Material;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();

        return view('materials/list-materials')->with('materials', $materials);
    }

    public function create()
    {
        $categories = Category::all();
        return view('materials/create-material')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' =>'min:5',
            'authors' => 'min:2',
            'descriprion' => 'min:10'
        ]);

        Material::create([
            'type' => $request->type,
            'category' => $request->category,
            'title' =>  $request->title,
            'authors' => $request->authors,
            'description' =>  $request->description
        ]);

        return redirect('/');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'min:2'
        ]);

        $search = $request->search;

        $materials = Material::query()->where('title', 'LIKE', "%{$search}%")->orWhere('authors', 'LIKE', "%{$search}%")
                            ->orWhereHas('tags', function ($q) use ($search) {
                                return $q->where('title', 'LIKE', "%{$search}%");
                            })->orWhereHas('categori', function ($q) use ($search) {
                                return $q->where('title', 'LIKE', "%{$search}%");
                            })->get();


        return view('search')->with([
            'search' => $materials,
            'request' => $search
        ]);
    }

    public function delete($id)
    {
        $item = Material::find($id);

        $item->delete();

        return back();
    }

    public function edit($id)
    {
        $categories = Category::all();
        $item = Material::find($id);

        return view('materials/create-material')->with([
            'material' => $item,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'catefory' => 'required',
            'title' =>'required|min:5',
            'authors' => 'required|min:2',
            'descriprion' => 'min:10'
        ]);        
        
        $item = Material::find($id);

        $item->update([
            'type' => $request->type,
            'category' => $request->category,
            'title' =>  $request->title,
            'authors' => $request->authors,
            'description' =>  $request->description
        ]);

        return redirect('/');
    }

    public function view($id)
    {

        $item = Material::find($id);
        $tags = Tag::all();
        $links = Link::all()->where('material_id', $id);


        return view('materials/view-material', ['id' => $id])->with([
            'material'=> $item,
            'tags' => $tags,
            'links' =>$links
        ]);
    }
}
