<?php

namespace App\Service;

use App\Models\Gallery;
use Illuminate\Http\Request;


class GalleryService
{

    public function showGalleries(Request $request)
    {
        $galleries = Gallery::paginate(10);

        return $galleries;
    }

    public function postGallery(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|string',
            'description' => 'max:1000',
            'urls' => 'required',
        ]);

        $gallery = new Gallery();

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = $request->urls;
        $gallery->author_id = $request->author_id;

        $gallery->save();

        return $gallery;
    }

    public function showGallery($id)
    {
        $gallery = Gallery::find($id);
        return $gallery;
    }

    public function editGallery(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255|string',
            'description' => 'max:1000',
            'urls' => 'required',
        ]);

        $gallery = Gallery::find($id);

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->urls = $request->urls;
        $gallery->save();

        return $gallery;
    }

    public function deleteGallery($id)
    {
        Gallery::destroy($id);
    }
}