<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $faqs = Faq::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('question', 'like', '%' . $search . '%')
                        ->orWhere('answer', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order', 'asc')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.faqs.index', compact('faqs', 'search'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        return view('admin.faqs.create');
    }

    /**
     * Store a newly created FAQ.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:faqs,slug',
            'short_question' => 'nullable|string|max:255',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:191',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:191',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug($validated['question']);
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['created_by'] = auth()->id();

        Faq::create($validated);

        return redirect()
            ->route('faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Display the specified FAQ.
     */
    public function show(Faq $faq)
    {
        return view('admin.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified FAQ.
     */
    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:faqs,slug,' . $faq->id,
            'short_question' => 'nullable|string|max:255',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:191',
            'order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'seo_title' => 'nullable|string|max:191',
            'seo_keywords' => 'nullable|string',
            'seo_description' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug(
                $validated['question'],
                $faq->id
            );
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['status'] = $request->boolean('status');
        $validated['is_featured'] = $request->boolean('is_featured');

        $faq->update($validated);

        return redirect()
            ->route('faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified FAQ.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()
            ->route('faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }

    /**
     * Generate a unique slug.
     */
    private function generateUniqueSlug(string $question, ?int $ignoreId = null): string
    {
        $slug = Str::slug($question);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Faq::where('slug', $slug)
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
