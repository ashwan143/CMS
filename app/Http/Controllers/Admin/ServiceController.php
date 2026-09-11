<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $services = Service::when($request->search, function ($query) use ($request) {

        $query->where('title', 'like', '%' . $request->search . '%');

    })
    ->orderBy('id', 'desc')
    ->paginate(10);

    return view('admin.services.index', compact('services'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('admin.services.create');
}

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{

    $request->validate([

        'title' => 'required|string|max:255',

        'slug' => 'nullable|string|max:255|unique:services,slug',

        'short_description' => 'nullable|string',

        'description' => 'nullable|string',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'icon' => 'nullable|string',

        'status' => 'required|boolean',

        'display_order' => 'nullable|integer',

        'seo_title' => 'nullable|string|max:255',

        'seo_keywords' => 'nullable|string',

        'seo_description' => 'nullable|string',

    ]);


    // Auto Slug

    $slug = $request->slug
            ? Str::slug($request->slug)
            : Str::slug($request->title);



    // Image Upload

    $imagePath = null;


    if($request->hasFile('image')){

        $imagePath = $request->file('image')
            ->store('services','public');

    }



    // Save Service

    Service::create([

        'title' => $request->title,

        'slug' => $slug,

        'short_description' => $request->short_description,

        'description' => $request->description,

        'image' => $imagePath,

        'icon' => $request->icon,

        'status' => $request->status,

        'display_order' => $request->display_order ?? 0,

        'seo_title' => $request->seo_title,

        'seo_keywords' => $request->seo_keywords,

        'seo_description' => $request->seo_description,

    ]);



    return redirect()

        ->route('services.index')

        ->with('success','Service created successfully.');

}

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
{
    return view('admin.services.show', compact('service'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
{
    return view('admin.services.edit', compact('service'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
{

    $request->validate([

        'title' => 'required|string|max:255',

        'slug' => 'nullable|string|max:255|unique:services,slug,'.$service->id,

        'short_description' => 'nullable|string',

        'description' => 'nullable|string',

        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'icon' => 'nullable|string',

        'status' => 'required|boolean',

        'display_order' => 'nullable|integer',

        'seo_title' => 'nullable|string|max:255',

        'seo_keywords' => 'nullable|string',

        'seo_description' => 'nullable|string',

    ]);


    $slug = $request->slug
        ? Str::slug($request->slug)
        : Str::slug($request->title);



    $image = $service->image;


    // Upload New Image

    if($request->hasFile('image')){


        // Delete Old Image

        if($service->image){

            Storage::disk('public')
                ->delete($service->image);

        }


        $image = $request->file('image')
                ->store('services','public');

    }



    $service->update([

        'title' => $request->title,

        'slug' => $slug,

        'short_description' => $request->short_description,

        'description' => $request->description,

        'image' => $image,

        'icon' => $request->icon,

        'status' => $request->status,

        'display_order' => $request->display_order ?? 0,

        'seo_title' => $request->seo_title,

        'seo_keywords' => $request->seo_keywords,

        'seo_description' => $request->seo_description,

    ]);



    return redirect()

        ->route('services.index')

        ->with('success','Service updated successfully.');

}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Service $service)
{

    // Delete Image
    if($service->image){

        Storage::disk('public')
            ->delete($service->image);

    }


    // Delete Service
    $service->delete();


    return redirect()

        ->route('services.index')

        ->with('success','Service deleted successfully.');

}
}
