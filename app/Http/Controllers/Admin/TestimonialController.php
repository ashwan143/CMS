<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    /**
     * Display testimonials.
     */
    public function index(Request $request): View
    {
        $query = Testimonial::with('project');

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('testimonial', 'like', "%{$search}%");

            });
        }

        // Status Filter
        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        // Rating Filter
        if ($request->filled('rating')) {

            $query->where(
                'rating',
                $request->rating
            );
        }

        // Featured Filter
        if ($request->filled('featured')) {

            $query->where(
                'is_featured',
                $request->featured
            );
        }

        // Project Filter
        if ($request->filled('project_id')) {

            $query->where(
                'project_id',
                $request->project_id
            );
        }

        $testimonials = $query
            ->orderBy('display_order')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        $projects = Project::orderBy('title')
            ->get();

        return view(
            'admin.testimonials.index',
            compact(
                'testimonials',
                'projects'
            )
        );
    }


    /**
     * Show create form.
     */
    public function create(): View
    {
        $projects = Project::orderBy('title')
            ->get();

        return view(
            'admin.testimonials.create',
            compact('projects')
        );
    }


    /**
     * Store testimonial.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTestimonial($request);

        // Client Photo
        if ($request->hasFile('client_photo')) {

            $validated['client_photo'] = $request
                ->file('client_photo')
                ->store('testimonials/clients', 'public');
        }

        // Company Logo
        if ($request->hasFile('company_logo')) {

            $validated['company_logo'] = $request
                ->file('company_logo')
                ->store('testimonials/companies', 'public');
        }

        // Created By
        $validated['created_by'] = auth()->id();

        // Default Display Order
        $validated['display_order'] =
            $validated['display_order'] ?? 0;

        // Default Rating
        $validated['rating'] =
            $validated['rating'] ?? 5;

        Testimonial::create($validated);

        return redirect()
            ->route('testimonials.index')
            ->with(
                'success',
                'Testimonial created successfully.'
            );
    }


    /**
     * Display single testimonial.
     */
    public function show(
        Testimonial $testimonial
    ): View {

        $testimonial->load([
            'project',
            'createdBy',
        ]);

        return view(
            'admin.testimonials.show',
            compact('testimonial')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(
        Testimonial $testimonial
    ): View {

        $projects = Project::orderBy('title')
            ->get();

        return view(
            'admin.testimonials.edit',
            compact(
                'testimonial',
                'projects'
            )
        );
    }


    /**
     * Update testimonial.
     */
    public function update(
        Request $request,
        Testimonial $testimonial
    ): RedirectResponse {

        $validated = $this->validateTestimonial(
            $request,
            false
        );

        /*
        |--------------------------------------------------------------------------
        | Keep Existing Client Photo
        |--------------------------------------------------------------------------
        */

        $validated['client_photo'] =
            $testimonial->client_photo;


        /*
        |--------------------------------------------------------------------------
        | Replace Client Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('client_photo')) {

            if (
                $testimonial->client_photo &&
                Storage::disk('public')->exists(
                    $testimonial->client_photo
                )
            ) {

                Storage::disk('public')->delete(
                    $testimonial->client_photo
                );
            }

            $validated['client_photo'] =
                $request
                    ->file('client_photo')
                    ->store(
                        'testimonials/clients',
                        'public'
                    );
        }


        /*
        |--------------------------------------------------------------------------
        | Keep Existing Company Logo
        |--------------------------------------------------------------------------
        */

        $validated['company_logo'] =
            $testimonial->company_logo;


        /*
        |--------------------------------------------------------------------------
        | Replace Company Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('company_logo')) {

            if (
                $testimonial->company_logo &&
                Storage::disk('public')->exists(
                    $testimonial->company_logo
                )
            ) {

                Storage::disk('public')->delete(
                    $testimonial->company_logo
                );
            }

            $validated['company_logo'] =
                $request
                    ->file('company_logo')
                    ->store(
                        'testimonials/companies',
                        'public'
                    );
        }


        $testimonial->update($validated);

        return redirect()
            ->route(
                'testimonials.index'
            )
            ->with(
                'success',
                'Testimonial updated successfully.'
            );
    }


    /**
     * Delete testimonial.
     */
    public function destroy(
        Testimonial $testimonial
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Delete Client Photo
        |--------------------------------------------------------------------------
        */

        if (
            $testimonial->client_photo &&
            Storage::disk('public')->exists(
                $testimonial->client_photo
            )
        ) {

            Storage::disk('public')->delete(
                $testimonial->client_photo
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Company Logo
        |--------------------------------------------------------------------------
        */

        if (
            $testimonial->company_logo &&
            Storage::disk('public')->exists(
                $testimonial->company_logo
            )
        ) {

            Storage::disk('public')->delete(
                $testimonial->company_logo
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $testimonial->delete();

        return redirect()
            ->route(
                'testimonials.index'
            )
            ->with(
                'success',
                'Testimonial deleted successfully.'
            );
    }


    /**
     * Validate testimonial.
     */
    private function validateTestimonial(
        Request $request,
        bool $creating = true
    ): array {

        return $request->validate([

            'client_name' => [
                'required',
                'string',
                'max:255',
            ],

            'designation' => [
                'nullable',
                'string',
                'max:255',
            ],

            'company_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'client_photo' => [
                $creating
                    ? 'nullable'
                    : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'company_logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'testimonial' => [
                'required',
                'string',
                'min:10',
            ],

            'rating' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],

            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'is_featured' => [
                'nullable',
                'boolean',
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'photo_alt' => [
                'nullable',
                'string',
                'max:255',
            ],

            'logo_alt' => [
                'nullable',
                'string',
                'max:255',
            ],

        ]);
    }
}
