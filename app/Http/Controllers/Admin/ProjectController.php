<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display projects list.
     */
    public function index(Request $request)
    {
        $query = Project::with('creator')
            ->orderBy('display_order', 'asc')
            ->latest();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('client_name', 'like', '%' . $search . '%')
                    ->orWhere('category', 'like', '%' . $search . '%');

            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pagination
        $projects = $query
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.projects.create');
    }


    /**
     * Store new project.
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
                'required',
                'string',
                'max:255',
                'unique:projects,slug',
            ],

            'category' => [
                'nullable',
                'string',
                'max:255',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'client_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'project_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'completion_date' => [
                'nullable',
                'date',
            ],

            'display_order' => [
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

        $validated['slug'] = Str::slug($validated['slug']);


        /*
        |--------------------------------------------------------------------------
        | Upload Featured Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('projects', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Created By
        |--------------------------------------------------------------------------
        */

        $validated['created_by'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Create Project
        |--------------------------------------------------------------------------
        */

        Project::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project created successfully.');
    }


    /**
     * Display single project.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }


    /**
     * Edit project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }


    /**
     * Update project.
     */
  public function update(Request $request, Project $project)
{
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
            'unique:projects,slug,' . $project->id,
        ],

        'category' => [
            'nullable',
            'string',
            'max:255',
        ],

        'short_description' => [
            'nullable',
            'string',
        ],

        'description' => [
            'nullable',
            'string',
        ],

        'image' => [
            'nullable',
            'image',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',
        ],

        'client_name' => [
            'nullable',
            'string',
            'max:255',
        ],

        'project_url' => [
            'nullable',
            'url',
            'max:255',
        ],

        'completion_date' => [
            'nullable',
            'date',
        ],

        'display_order' => [
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

    $validated['slug'] = Str::slug($validated['slug']);


    /*
    |--------------------------------------------------------------------------
    | Upload New Image
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('image')) {

        // Delete old image
        if ($project->image) {

            Storage::disk('public')->delete(
                $project->image
            );
        }


        // Store new image
        $validated['image'] = $request
            ->file('image')
            ->store('projects', 'public');
    }


    /*
    |--------------------------------------------------------------------------
    | Update Project
    |--------------------------------------------------------------------------
    */

    $project->update($validated);


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('projects.index')
        ->with('success', 'Project updated successfully.');
}


    /**
     * Delete project.
     */
    public function destroy(Project $project)
{
    /*
    |--------------------------------------------------------------------------
    | Delete Project Image
    |--------------------------------------------------------------------------
    */

    if ($project->image) {

        \Illuminate\Support\Facades\Storage::disk('public')
            ->delete($project->image);
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Project
    |--------------------------------------------------------------------------
    */

    $project->delete();


    /*
    |--------------------------------------------------------------------------
    | Redirect
    |--------------------------------------------------------------------------
    */

    return redirect()
        ->route('projects.index')
        ->with(
            'success',
            'Project deleted successfully.'
        );
}
}
