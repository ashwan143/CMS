<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SliderController extends Controller
{
    /**
     * Display a listing of sliders.
     */
    public function index(Request $request): View
    {
        $query = Slider::query()
            ->with([
                'createdBy',
                'updatedBy',
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
                    ->orWhere('subtitle', 'like', "%{$search}%");

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
        | Ordering
        |--------------------------------------------------------------------------
        */

        $sliders = $query
            ->orderBy('display_order')
            ->orderBy('title')
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.sliders.index',
            compact('sliders')
        );
    }


    /**
     * Show the form for creating a new slider.
     */
    public function create(): View
    {
        return view(
            'admin.sliders.create'
        );
    }


    /**
     * Store a newly created slider.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateSlider($request);


        /*
        |--------------------------------------------------------------------------
        | Desktop Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('sliders', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Mobile Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('mobile_image')) {

            $validated['mobile_image'] = $request
                ->file('mobile_image')
                ->store('sliders', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Audit
        |--------------------------------------------------------------------------
        */

        $validated['created_by'] = Auth::id();

        $validated['updated_by'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Defaults
        |--------------------------------------------------------------------------
        */

        $validated['display_order'] =
            $validated['display_order'] ?? 0;

        $validated['status'] =
            $validated['status'] ?? false;


        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        Slider::create($validated);


        return redirect()
            ->route('sliders.index')
            ->with(
                'success',
                'Slider created successfully.'
            );
    }


    /**
     * Display the specified slider.
     */
    public function show(Slider $slider): View
    {
        $slider->load([
            'createdBy',
            'updatedBy',
        ]);

        return view(
            'admin.sliders.show',
            compact('slider')
        );
    }


    /**
     * Show the form for editing the specified slider.
     */
    public function edit(Slider $slider): View
    {
        return view(
            'admin.sliders.edit',
            compact('slider')
        );
    }


    /**
     * Update the specified slider.
     */
    public function update(
        Request $request,
        Slider $slider
    ): RedirectResponse {

        $validated = $this->validateSlider(
            $request,
            $slider
        );


        /*
        |--------------------------------------------------------------------------
        | Desktop Image Replacement
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $slider->image &&
                Storage::disk('public')->exists($slider->image)
            ) {
                Storage::disk('public')->delete(
                    $slider->image
                );
            }


            $validated['image'] = $request
                ->file('image')
                ->store('sliders', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Mobile Image Replacement
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('mobile_image')) {

            if (
                $slider->mobile_image &&
                Storage::disk('public')->exists(
                    $slider->mobile_image
                )
            ) {
                Storage::disk('public')->delete(
                    $slider->mobile_image
                );
            }


            $validated['mobile_image'] = $request
                ->file('mobile_image')
                ->store('sliders', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Audit
        |--------------------------------------------------------------------------
        */

        $validated['updated_by'] = Auth::id();


        /*
        |--------------------------------------------------------------------------
        | Defaults
        |--------------------------------------------------------------------------
        */

        $validated['display_order'] =
            $validated['display_order'] ?? 0;

        $validated['status'] =
            $validated['status'] ?? false;


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $slider->update($validated);


        return redirect()
            ->route('sliders.index')
            ->with(
                'success',
                'Slider updated successfully.'
            );
    }


    /**
     * Remove the specified slider.
     */
    public function destroy(
        Slider $slider
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | Delete Desktop Image
        |--------------------------------------------------------------------------
        */

        if (
            $slider->image &&
            Storage::disk('public')->exists(
                $slider->image
            )
        ) {
            Storage::disk('public')->delete(
                $slider->image
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Mobile Image
        |--------------------------------------------------------------------------
        */

        if (
            $slider->mobile_image &&
            Storage::disk('public')->exists(
                $slider->mobile_image
            )
        ) {
            Storage::disk('public')->delete(
                $slider->mobile_image
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Database Record
        |--------------------------------------------------------------------------
        */

        $slider->delete();


        return redirect()
            ->route('sliders.index')
            ->with(
                'success',
                'Slider deleted successfully.'
            );
    }


    /**
     * Validate slider data.
     */
    private function validateSlider(
        Request $request,
        ?Slider $slider = null
    ): array {

        return $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Content
            |--------------------------------------------------------------------------
            */

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
            ],


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'image' => [
                $slider ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'mobile_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],


            /*
            |--------------------------------------------------------------------------
            | Primary Button
            |--------------------------------------------------------------------------
            */

            'button_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'button_url' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'button_target' => [
                'required',
                'in:_self,_blank',
            ],


            /*
            |--------------------------------------------------------------------------
            | Alignment
            |--------------------------------------------------------------------------
            */

            'alignment' => [
                'required',
                'in:left,center,right',
            ],


            /*
            |--------------------------------------------------------------------------
            | Ordering
            |--------------------------------------------------------------------------
            */

            'display_order' => [
                'nullable',
                'integer',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'nullable',
                'boolean',
            ],


            /*
            |--------------------------------------------------------------------------
            | Scheduling
            |--------------------------------------------------------------------------
            */

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

        ]);
    }
}
