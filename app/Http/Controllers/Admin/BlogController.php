<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $query = Blog::with([
            'category',
            'author',
            'tags',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%");
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {

            $query->where(
                'category_id',
                $request->category_id
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

        $blogs = $query
            ->orderBy('order')
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        $categories = BlogCategory::where('status', true)
            ->orderBy('name')
            ->get();


        return view(
            'admin.blogs.index',
            compact(
                'blogs',
                'categories'
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
        $categories = BlogCategory::where('status', true)
            ->orderBy('name')
            ->get();

        $tags = BlogTag::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.blogs.create',
            compact(
                'categories',
                'tags'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBlog($request);


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = $this->generateUniqueSlug(
            $validated['title']
        );


        /*
        |--------------------------------------------------------------------------
        | Featured Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('featured_image')) {

            $validated['featured_image'] =
                $request->file('featured_image')
                    ->store('blogs', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $validated['status'] =
            $request->boolean('status');


        /*
        |--------------------------------------------------------------------------
        | Published Date
        |--------------------------------------------------------------------------
        */

        if (
            $validated['status'] &&
            empty($validated['published_at'])
        ) {

            $validated['published_at'] = now();
        }


        /*
        |--------------------------------------------------------------------------
        | Author
        |--------------------------------------------------------------------------
        */

        $validated['author_id'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Display Order
        |--------------------------------------------------------------------------
        */

        $validated['order'] =
            $validated['order'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Create Blog
        |--------------------------------------------------------------------------
        */

        $blog = Blog::create($validated);


        /*
        |--------------------------------------------------------------------------
        | Tags
        |--------------------------------------------------------------------------
        */

        $blog->tags()->sync(
            $request->input('tags', [])
        );


        return redirect()
            ->route('blogs.index')
            ->with(
                'success',
                'Blog created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    */

    public function show(Blog $blog): View
    {
        $blog->load([
            'category',
            'author',
            'tags',
        ]);

        return view(
            'admin.blogs.show',
            compact('blog')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Blog $blog): View
    {
        $categories = BlogCategory::where('status', true)
            ->orderBy('name')
            ->get();

        $tags = BlogTag::where('status', true)
            ->orderBy('name')
            ->get();

        $blog->load('tags');

        return view(
            'admin.blogs.edit',
            compact(
                'blog',
                'categories',
                'tags'
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
        Blog $blog
    ): RedirectResponse {

        $validated = $this->validateBlog(
            $request,
            $blog
        );


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('title') &&
            $request->title !== $blog->title
        ) {

            $validated['slug'] =
                $this->generateUniqueSlug(
                    $request->title,
                    $blog->id
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Featured Image Replacement
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('featured_image')) {

            if (
                $blog->featured_image &&
                Storage::disk('public')
                    ->exists($blog->featured_image)
            ) {

                Storage::disk('public')
                    ->delete($blog->featured_image);
            }


            $validated['featured_image'] =
                $request->file('featured_image')
                    ->store('blogs', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $validated['status'] =
            $request->boolean('status');


        /*
        |--------------------------------------------------------------------------
        | Published Date
        |--------------------------------------------------------------------------
        */

        if (
            $validated['status'] &&
            empty($blog->published_at)
        ) {

            $validated['published_at'] = now();
        }


        /*
        |--------------------------------------------------------------------------
        | Update Blog
        |--------------------------------------------------------------------------
        */

        $blog->update($validated);


        /*
        |--------------------------------------------------------------------------
        | Sync Tags
        |--------------------------------------------------------------------------
        */

        $blog->tags()->sync(
            $request->input('tags', [])
        );


        return redirect()
            ->route('blogs.index')
            ->with(
                'success',
                'Blog updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Blog $blog
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Delete Featured Image
        |--------------------------------------------------------------------------
        */

        if (
            $blog->featured_image &&
            Storage::disk('public')
                ->exists($blog->featured_image)
        ) {

            Storage::disk('public')
                ->delete($blog->featured_image);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Blog
        |--------------------------------------------------------------------------
        */

        $blog->delete();


        return redirect()
            ->route('blogs.index')
            ->with(
                'success',
                'Blog deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Blog Validation
    |--------------------------------------------------------------------------
    */

    private function validateBlog(
        Request $request,
        ?Blog $blog = null
    ): array {

        $slugRule = 'unique:blogs,slug';

        if ($blog) {

            $slugRule .= ',' . $blog->id;
        }


        return $request->validate([

            'category_id' => [
                'nullable',
                'exists:blog_categories,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'short_description' => [
                'nullable',
                'string',
            ],

            'content' => [
                'required',
                'string',
            ],

            'featured_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],

            'seo_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'seo_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'tags' => [
                'nullable',
                'array',
            ],

            'tags.*' => [
                'integer',
                'exists:blog_tags,id',
            ],

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Unique Slug
    |--------------------------------------------------------------------------
    */

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $slug = Str::slug($title);

        $originalSlug = $slug;

        $counter = 1;


        while (
            Blog::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where('id', '!=', $ignoreId)
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
