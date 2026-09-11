<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AlbumController extends Controller
{
    /**
     * Display a listing of albums.
     */
    public function index(Request $request): View
    {
        $query = Album::with('createdBy')
            ->withCount('galleryImages');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");

            });
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
        | Albums
        |--------------------------------------------------------------------------
        */

        $albums = $query
            ->orderBy('order')
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();

        return view(
            'admin.albums.index',
            compact('albums')
        );
    }


    /**
     * Show the form for creating a new album.
     */
    public function create(): View
    {
        return view('admin.albums.create');
    }


    /**
     * Store a newly created album.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAlbum($request);

        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] =
            $this->generateUniqueSlug(
                $validated['title']
            );

        /*
        |--------------------------------------------------------------------------
        | Created By
        |--------------------------------------------------------------------------
        */

        $validated['created_by'] =
            Auth::id();

        /*
        |--------------------------------------------------------------------------
        | Cover Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            $validated['cover_image'] =
                $request
                    ->file('cover_image')
                    ->store('albums', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Default Order
        |--------------------------------------------------------------------------
        */

        $validated['order'] =
            $validated['order'] ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Create Album
        |--------------------------------------------------------------------------
        */

        Album::create($validated);

        return redirect()
            ->route('albums.index')
            ->with(
                'success',
                'Album created successfully.'
            );
    }


    /**
     * Display the specified album.
     */
    public function show(Album $album): View
    {
        $album->load([
            'createdBy',
            'galleryImages' => function ($query) {
                $query
                    ->orderBy('order')
                    ->orderBy('id');
            },
        ]);

        return view(
            'admin.albums.show',
            compact('album')
        );
    }


    /**
     * Show the form for editing the specified album.
     */
    public function edit(Album $album): View
    {
        return view(
            'admin.albums.edit',
            compact('album')
        );
    }


    /**
     * Update the specified album.
     */
    public function update(
        Request $request,
        Album $album
    ): RedirectResponse {

        $validated = $this->validateAlbum(
            $request,
            $album
        );

        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if ($album->title !== $validated['title']) {

            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $album->id
                );

        } else {

            $validated['slug'] =
                $album->slug;
        }

        /*
        |--------------------------------------------------------------------------
        | Cover Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            /*
            | Delete old image
            */

            if (
                $album->cover_image &&
                Storage::disk('public')
                    ->exists($album->cover_image)
            ) {

                Storage::disk('public')
                    ->delete($album->cover_image);
            }

            /*
            | Store new image
            */

            $validated['cover_image'] =
                $request
                    ->file('cover_image')
                    ->store('albums', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Album
        |--------------------------------------------------------------------------
        */

        $album->update($validated);

        return redirect()
            ->route(
                'albums.index'
            )
            ->with(
                'success',
                'Album updated successfully.'
            );
    }


    /**
     * Remove the specified album.
     */
    public function destroy(
        Album $album
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Delete Cover Image
        |--------------------------------------------------------------------------
        */

        if (
            $album->cover_image &&
            Storage::disk('public')
                ->exists($album->cover_image)
        ) {

            Storage::disk('public')
                ->delete($album->cover_image);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Album
        |--------------------------------------------------------------------------
        |
        | gallery_images.album_id uses cascadeOnDelete(),
        | so associated gallery image records will be removed
        | automatically by the database.
        |
        */

        $album->delete();

        return redirect()
            ->route(
                'albums.index'
            )
            ->with(
                'success',
                'Album deleted successfully.'
            );
    }


    /**
     * Validate album data.
     */
    private function validateAlbum(
        Request $request,
        ?Album $album = null
    ): array {

        return $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
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
    }


    /**
     * Generate a unique slug.
     */
    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($title);

        $originalSlug = $slug;

        $counter = 1;

        while (
            Album::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where(
                            'id',
                            '!=',
                            $ignoreId
                        )
                )
                ->exists()
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }

        return $slug;
    }
}
