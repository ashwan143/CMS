<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of pages.
     */
    public function index(Request $request)
    {
        $query = Page::with(['createdBy', 'updatedBy']);

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
        | Pagination
        |--------------------------------------------------------------------------
        */
        $pages = $query
            ->orderBy('display_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.pages.index',
            compact('pages')
        );
    }


    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        return view('admin.pages.create');
    }


    /**
     * Store a newly created page.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:pages,slug',
            ],

            'template' => [
                'required',
                'string',
                'max:100',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'featured_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate Slug
        |--------------------------------------------------------------------------
        */
        $validated['slug'] = $validated['slug']
            ?? Str::slug($validated['title']);


        /*
        |--------------------------------------------------------------------------
        | Featured Image Upload
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('featured_image')) {

            $validated['featured_image'] = $request
                ->file('featured_image')
                ->store('pages', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Created By
        |--------------------------------------------------------------------------
        */
        $validated['created_by'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Default Display Order
        |--------------------------------------------------------------------------
        */
        $validated['display_order'] =
            $validated['display_order'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Create Page
        |--------------------------------------------------------------------------
        */
        Page::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('pages.index')
            ->with(
                'success',
                'Page created successfully.'
            );
    }


    /**
     * Display the specified page.
     */
    public function show(Page $page)
    {
        return view(
            'admin.pages.show',
            compact('page')
        );
    }


    /**
     * Show the form for editing the specified page.
     */
    public function edit(Page $page)
    {
        return view(
            'admin.pages.edit',
            compact('page')
        );
    }


    /**
     * Update the specified page.
     */
    public function update(
        Request $request,
        Page $page
    ) {

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:pages,slug,' . $page->id,
            ],

            'template' => [
                'required',
                'string',
                'max:100',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'featured_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Featured Image Replacement
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('featured_image')) {

            if ($page->featured_image) {

                Storage::disk('public')
                    ->delete($page->featured_image);
            }

            $validated['featured_image'] = $request
                ->file('featured_image')
                ->store('pages', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Updated By
        |--------------------------------------------------------------------------
        */
        $validated['updated_by'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Default Display Order
        |--------------------------------------------------------------------------
        */
        $validated['display_order'] =
            $validated['display_order'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Update Page
        |--------------------------------------------------------------------------
        */
        $page->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */
        return redirect()
            ->route('pages.index')
            ->with(
                'success',
                'Page updated successfully.'
            );
    }


    /**
     * Remove the specified page.
     */
    public function destroy(Page $page)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Featured Image
        |--------------------------------------------------------------------------
        */
        if ($page->featured_image) {

            Storage::disk('public')
                ->delete($page->featured_image);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Page
        |--------------------------------------------------------------------------
        */
        $page->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------

        */
        return redirect()
            ->route('pages.index')
            ->with(
                'success',
                'Page deleted successfully.'
            );
    }
}
