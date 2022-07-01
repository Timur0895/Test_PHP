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
        //dd($request);

        $material = Material::create([
            'type' => $request->type,
            'category' => $request->category,
            'title' =>  $request->title,
            'authors' => $request->authors,
            'description' =>  $request->description
        ]);

        //dd($material);

        return redirect('/');
    }

    public function search(Request $request)
    {
        //dd($request);
        $search = $request->search;

        $materials = Material::query()->where('title', 'LIKE', "%{$search}%")->orWhere('authors', 'LIKE', "%{$search}%")->get();

        //dd($materials);

        return view('search')->with('search', $materials);
    }

    public function delete($id)
    {
        //dd($id);
        $item = Material::find($id);

        $item->delete();

        return back();
    }

    public function edit($id)
    {
        //dd($id);
        $categories = Category::all();
        $item = Material::find($id);

        return view('materials/create-material')->with([
            'material' => $item,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        //dd($request);
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
        $item_tags = $item->tags;
        $links = Link::all()->where('material_id', $id);

 
        //dd($item_tags);

        return view('materials/view-material', ['id' => $id])->with([
            'material'=> $item,
            'tags' => $tags,
            'item_tags' => $item_tags,
            'links' =>$links
        ]);
    }

    public function addTag(Request $request, $id)
    {
        //dd($request->tag);
        $tag_id = $request->tag;
        $material_id = $id;

        DB::table('tag_item')->insert([
            'tag_id' => $tag_id,
            'material_id' =>$material_id
        ]);

        return redirect(route('viewMaterial', ['id' => $id]));
    }

    public function deleteTag($id)
    {
        $tag = Tag::find($id);

        $tag->delete();

        return back();
    }

    public function addLink(Request $request, $id)
    {
        //dd($request->has('title'));
        $link = $request->url;
        if($request->has('title')){
            DB::table('links')->insert([
                'title' => $request->title,
                'url' => $link,
                'material_id' => $id
            ]);
        } else {
            DB::table('links')->insert([
                'url' => $link,
                'material_id' => $id
            ]); 
        };

        return redirect(route('viewMaterial', ['id' => $id]));
    }

    public function deleteLink($id)
    {
        $link = Link::find($id);

        $link->delete();

        return back();
    }

    public function editLink($id)
    {
        //dd($id);
        $link = Link::find($id);

        return view('materials/editLink')->with('link', $link);
    }

    public function updateLink(Request $request, $id)
    {
        //dd($id);
        $link = Link::find($id);

        if($request->has('title'))
        {
            $link->update([
                'title' => $request->title,
                'url' => $request->url
            ]);
        } else {
            $link->update([
                'url' => $request->url
            ]);
        }


        return redirect('/');
    }

    public function searchTag($id)
    {
        //dd($id);
        $tag = Tag::find($id);
        $materials = $tag->materials;
        //dd($materials);

        return view('tags/search-tag')->with([
            'tag' =>  $tag,
            'materials' => $materials
        ]);
    }
}
