<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Tag;
use Illuminate\Http\Request;

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
        //dd($request);

        Tag::create([
            'title' => $request->title
        ]);

        return redirect(route('tags'));
    }

    public function delete($id)
    {
        $tag = Tag::find($id);

        //dd($tag);

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
        $tag = Tag::find($id);

        $tag->update([
            'title' => $request->title
        ]);

        return redirect(route('tags'));

        //dd($request);
    }
}
