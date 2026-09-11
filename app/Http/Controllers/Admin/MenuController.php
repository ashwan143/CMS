<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    /**
     * Display a listing of menus.
     */
    public function index(Request $request): View
    {
        $query = Menu::with(['parent', 'page'])
            ->orderBy('location')
            ->orderBy('display_order');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Location Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */
        $menus = $query->paginate(15)->withQueryString();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create(): View
    {
        $pages = Page::where('status', true)
            ->orderBy('title')
            ->get();

        $parents = Menu::whereNull('parent_id')
            ->orderBy('location')
            ->orderBy('display_order')
            ->orderBy('title')
            ->get();

        return view('admin.menus.create', compact('pages', 'parents'));
    }

    /**
     * Store a newly created menu.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateMenu($request);

        Menu::create($validated);

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu created successfully.');
    }

    /**
     * Display the specified menu.
     */
    public function show(Menu $menu): View
    {
        $menu->load([
            'parent',
            'children' => function ($query) {
                $query->orderBy('display_order');
            },
            'page',
        ]);

        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified menu.
     */
    public function edit(Menu $menu): View
    {
        $pages = Page::where('status', true)
            ->orderBy('title')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Parent Menu Options
        |--------------------------------------------------------------------------
        | The current menu cannot become its own parent.
        */
        $parents = Menu::whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->orderBy('location')
            ->orderBy('display_order')
            ->orderBy('title')
            ->get();

        return view('admin.menus.edit', compact(
            'menu',
            'pages',
            'parents'
        ));
    }

    /**
     * Update the specified menu.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $this->validateMenu($request, $menu);

        $menu->update($validated);

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu updated successfully.');
    }

    /**
     * Remove the specified menu.
     */
    public function destroy(Menu $menu): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Child Menu Protection
        |--------------------------------------------------------------------------
        | We do not delete a menu branch accidentally.
        */
        if ($menu->children()->exists()) {
            return redirect()
                ->route('menus.index')
                ->with('error', 'This menu cannot be deleted because it has child menu items.');
        }

        $menu->delete();

        return redirect()
            ->route('menus.index')
            ->with('success', 'Menu deleted successfully.');
    }

    /**
     * Validate menu data.
     */
    private function validateMenu(
        Request $request,
        ?Menu $menu = null
    ): array {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                Rule::in([
                    'page',
                    'custom_url',
                    'external_url',
                ]),
            ],

            'page_id' => [
                'nullable',
                'integer',
                'exists:pages,id',
            ],

            'url' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
            ],

            'target' => [
                'required',
                Rule::in([
                    '_self',
                    '_blank',
                ]),
            ],

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'location' => [
                'required',
                Rule::in([
                    'header',
                    'footer',
                    'mobile',
                    'sidebar',
                ]),
            ],

            'status' => [
                'nullable',
                'boolean',
            ],

            'parent_id' => [
                'nullable',
                'integer',
                'exists:menus,id',
                function ($attribute, $value, $fail) use ($menu) {
                    if ($menu && (int) $value === (int) $menu->id) {
                        $fail('A menu item cannot be its own parent.');
                    }
                },
            ],
        ]);
    }
}
