<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GalleryImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Gallery Images
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $query = GalleryImage::with('album');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('alt_text', 'like', "%{$search}%");

            });
        }

        /*
        |--------------------------------------------------------------------------
        | Album Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('album_id')) {

            $query->where(
                'album_id',
                $request->album_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Ordering
        |--------------------------------------------------------------------------
        */

        $galleryImages = $query
            ->orderBy('album_id')
            ->orderBy('order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Albums
        |--------------------------------------------------------------------------
        */

        $albums = Album::where('status', 1)
            ->orderBy('title')
            ->get();

        return view(
            'admin.gallery-images.index',
            compact(
                'galleryImages',
                'albums'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        $albums = Album::where('status', 1)
            ->orderBy('title')
            ->get();

        return view(
            'admin.gallery-images.create',
            compact('albums')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([

            'album_id' => [
                'required',
                'exists:albums,id',
            ],

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'alt_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $validated['image'] = $request
            ->file('image')
            ->store('gallery', 'public');

        /*
        |--------------------------------------------------------------------------
        | Default Order
        |--------------------------------------------------------------------------
        */

        $validated['order'] = $validated['order'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Create Gallery Image
        |--------------------------------------------------------------------------
        */

        GalleryImage::create($validated);

        return redirect()
            ->route('gallery-images.index')
            ->with(
                'success',
                'Gallery image added successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(GalleryImage $galleryImage): View
    {
        $galleryImage->load('album');

        return view(
            'admin.gallery-images.show',
            compact('galleryImage')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(GalleryImage $galleryImage): View
    {
        $albums = Album::where('status', 1)
            ->orderBy('title')
            ->get();

        return view(
            'admin.gallery-images.edit',
            compact(
                'galleryImage',
                'albums'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        GalleryImage $galleryImage
    ): RedirectResponse {

        $validated = $request->validate([

            'album_id' => [
                'required',
                'exists:albums,id',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:5120',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'alt_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'status' => [
                'required',
                'boolean',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $galleryImage->image &&
                Storage::disk('public')->exists(
                    $galleryImage->image
                )
            ) {

                Storage::disk('public')->delete(
                    $galleryImage->image
                );
            }

            $validated['image'] = $request
                ->file('image')
                ->store('gallery', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Default Order
        |--------------------------------------------------------------------------
        */

        $validated['order'] = $validated['order'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $galleryImage->update($validated);

        return redirect()
            ->route(
                'gallery-images.index'
            )
            ->with(
                'success',
                'Gallery image updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function destroy(
        GalleryImage $galleryImage
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Delete Physical Image
        |--------------------------------------------------------------------------
        */

        if (
            $galleryImage->image &&
            Storage::disk('public')->exists(
                $galleryImage->image
            )
        ) {

            Storage::disk('public')->delete(
                $galleryImage->image
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $galleryImage->delete();

        return redirect()
            ->route(
                'gallery-images.index'
            )
            ->with(
                'success',
                'Gallery image deleted successfully.'
            );
    }
}
