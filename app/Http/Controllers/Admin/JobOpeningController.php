<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobOpeningController extends Controller
{
    /**
     * Display a listing of job openings.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $jobOpenings = JobOpening::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                        ->orWhere('department', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%')
                        ->orWhere('employment_type', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order', 'asc')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.job-openings.index', compact('jobOpenings', 'search'));
    }

    /**
     * Show the form for creating a new job opening.
     */
    public function create()
    {
        return view('admin.job-openings.create');
    }

    /**
     * Store a newly created job opening.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:job_openings,slug',
            'department' => 'nullable|string|max:191',
            'location' => 'nullable|string|max:191',
            'employment_type' => 'nullable|string|max:191',
            'experience' => 'nullable|string|max:191',
            'salary' => 'nullable|string|max:191',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'application_email' => 'nullable|email|max:191',
            'deadline' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:191',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title']);
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['created_by'] = auth()->id();

        JobOpening::create($validated);

        return redirect()
            ->route('job-openings.index')
            ->with('success', 'Job opening created successfully.');
    }

    /**
     * Display the specified job opening.
     */
    public function show(JobOpening $jobOpening)
    {
        return view('admin.job-openings.show', compact('jobOpening'));
    }

    /**
     * Show the form for editing the specified job opening.
     */
    public function edit(JobOpening $jobOpening)
    {
        return view('admin.job-openings.edit', compact('jobOpening'));
    }

    /**
     * Update the specified job opening.
     */
    public function update(Request $request, JobOpening $jobOpening)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:job_openings,slug,' . $jobOpening->id,
            'department' => 'nullable|string|max:191',
            'location' => 'nullable|string|max:191',
            'employment_type' => 'nullable|string|max:191',
            'experience' => 'nullable|string|max:191',
            'salary' => 'nullable|string|max:191',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'application_email' => 'nullable|email|max:191',
            'deadline' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:191',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug(
                $validated['title'],
                $jobOpening->id
            );
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['is_featured'] = $request->boolean('is_featured');

        $jobOpening->update($validated);

        return redirect()
            ->route('job-openings.index')
            ->with('success', 'Job opening updated successfully.');
    }

    /**
     * Remove the specified job opening.
     */
    public function destroy(JobOpening $jobOpening)
    {
        $jobOpening->delete();

        return redirect()
            ->route('job-openings.index')
            ->with('success', 'Job opening deleted successfully.');
    }

    /**
     * Generate a unique slug.
     */
    private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            JobOpening::where('slug', $slug)
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
