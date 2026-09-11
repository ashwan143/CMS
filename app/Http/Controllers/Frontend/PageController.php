<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Display a published CMS page.
     */
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view('frontend.page', compact('page'));
    }
}
