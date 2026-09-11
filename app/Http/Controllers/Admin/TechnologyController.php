<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TechnologyController extends Controller
{
    /**
     * Display a listing of technologies.
     */
    public function index(Request $request)
    {
        $query = Technology::query();


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
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
        | Technologies List
        |--------------------------------------------------------------------------
        */

        $technologies = $query
            ->orderBy('order', 'asc')
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.technologies.index',
            compact('technologies')
        );
    }


    /**
     * Show the form for creating a new technology.
     */
    public function create()
    {
        return view(
            'admin.technologies.create'
        );
    }


    /**
     * Store a newly created technology.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:technologies,name',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:technologies,slug',
            ],

            'icon' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
            ],

            'description' => [
                'nullable',
                'string',
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
        | Generate Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug(
            $validated['slug'] ?? $validated['name']
        );


        /*
        |--------------------------------------------------------------------------
        | Upload Technology Icon
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {

            $validated['icon'] = $request
                ->file('icon')
                ->store('technologies', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Default Order
        |--------------------------------------------------------------------------
        */

        $validated['order'] = $validated['order'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Create Technology
        |--------------------------------------------------------------------------
        */

        Technology::create($validated);


        return redirect()
            ->route('technologies.index')
            ->with(
                'success',
                'Technology created successfully.'
            );
    }


    /**
     * Display the specified technology.
     */
    public function show(Technology $technology)
    {
        $technology->load('projects');

        return view(
            'admin.technologies.show',
            compact('technology')
        );
    }


    /**
     * Show the form for editing the technology.
     */
    public function edit(Technology $technology)
    {
        return view(
            'admin.technologies.edit',
            compact('technology')
        );
    }


    /**
     * Update the specified technology.
     */
    public function update(
        Request $request,
        Technology $technology
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
                'unique:technologies,name,' . $technology->id,
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:technologies,slug,' . $technology->id,
            ],

            'icon' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048',
            ],

            'description' => [
                'nullable',
                'string',
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
        | Generate Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug(
            $validated['slug'] ?? $validated['name']
        );


        /*
        |--------------------------------------------------------------------------
        | Upload New Icon
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {

            if ($technology->icon) {

                Storage::disk('public')->delete(
                    $technology->icon
                );
            }


            $validated['icon'] = $request
                ->file('icon')
                ->store('technologies', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Default Order
        |--------------------------------------------------------------------------
        */

        $validated['order'] = $validated['order'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Update Technology
        |--------------------------------------------------------------------------
        */

        $technology->update($validated);


        return redirect()
            ->route('technologies.index')
            ->with(
                'success',
                'Technology updated successfully.'
            );
    }


  /**
 * Remove the specified technology.
 */
public function destroy(Technology $technology)
{
    /*
    |--------------------------------------------------------------------------
    | Delete Technology Icon
    |--------------------------------------------------------------------------
    */

    if ($technology->icon) {

        Storage::disk('public')->delete(
            $technology->icon
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Technology
    |--------------------------------------------------------------------------
    */

    $technology->delete();


    return redirect()
        ->route('technologies.index')
        ->with(
            'success',
            'Technology deleted successfully.'
        );
}
}
