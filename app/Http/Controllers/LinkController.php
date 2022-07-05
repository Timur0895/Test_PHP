<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Material;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function addLink(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3|max:25',
            'url' => 'required|min:6'
        ]);

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

    public function editLink($id, $title)
    {
        $material = Material::find($id);
        $link = Link::where('title', $title)->first();

        return view('materials/view-material', [
            'id' => $id,
            'link' => $link,
            'material' => $material,
            'title' => $link->title,
            'tags' => Tag::all(),
            'links' => Link::all()->where('material_id', $id)
        ]);
    }

    public function updateLink(Request $request, $id)
    {
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
}
