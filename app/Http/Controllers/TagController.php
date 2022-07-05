<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('tags/list-tags')->with('tags', $tags);
    }

    public function create()
    {
        return view('tags/create-tag');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2'
        ]);

        Tag::create([
            'title' => $request->title
        ]);

        return redirect(route('tags'));
    }

    public function delete($id)
    {
        $tag = Tag::find($id);

        $tag->delete();

        return back();
    }

    public function edit($id) 
    {
        $tag = Tag::find($id);

        return view('tags/create-tag')->with('tag', $tag);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:2'
        ]);

        $tag = Tag::find($id);

        $tag->update([
            'title' => $request->title
        ]);

        return redirect(route('tags'));
    }

    public function addTagToMaterial(Request $request, $id)
    {
        $tag_id = $request->tag;
        $material_id = $id;

        DB::table('tag_item')->insert([
            'tag_id' => $tag_id,
            'material_id' =>$material_id
        ]);

        return redirect(route('viewMaterial', ['id' => $id]));
    }

    public function deleteTagFromMaterial($id)
    {

        $tag = Tag::find($id);

        $tag->materials()->wherePivot('tag_id', '=', $tag->id)->detach();

        return back();
    }

    public function searchByTag($id)
    {
        $tag = Tag::find($id);

        $materials = $tag->materials;

        return view('tags/search-tag')->with([
            'tag' =>  $tag,
            'materials' => $materials
        ]);
    }
}
