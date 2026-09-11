```blade
{{-- Page Title --}}
<div class="mb-3">

    <label for="title" class="form-label">
        Page Title
        <span class="text-danger">*</span>
    </label>

    <input type="text"
           id="title"
           name="title"
           class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $page->title ?? '') }}"
           placeholder="Example: About Us"
           required>

    @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Slug --}}
<div class="mb-3">

    <label for="slug" class="form-label">
        URL Slug
        <span class="text-danger">*</span>
    </label>

    <input type="text"
           id="slug"
           name="slug"
           class="form-control @error('slug') is-invalid @enderror"
           value="{{ old('slug', $page->slug ?? '') }}"
           placeholder="about-us"
           required>

    <div class="form-text">
        Example: about-us
    </div>

    @error('slug')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Short Description --}}
<div class="mb-3">

    <label for="short_description" class="form-label">
        Short Description
    </label>

    <textarea id="short_description"
              name="short_description"
              rows="4"
              class="form-control @error('short_description') is-invalid @enderror"
              placeholder="Brief description of this page...">{{ old('short_description', $page->short_description ?? '') }}</textarea>

    @error('short_description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Content --}}
<div class="mb-3">

    <label for="content" class="form-label">
        Page Content
    </label>

    <textarea id="content"
              name="content"
              rows="15"
              class="form-control @error('content') is-invalid @enderror"
              placeholder="Write page content here...">{{ old('content', $page->content ?? '') }}</textarea>

    @error('content')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Template --}}
<div class="mb-3">

    <label for="template" class="form-label">
        Template
        <span class="text-danger">*</span>
    </label>

    <select id="template"
            name="template"
            class="form-select @error('template') is-invalid @enderror">

        <option value="default"
            {{ old('template', $page->template ?? 'default') === 'default' ? 'selected' : '' }}>
            Default
        </option>

        <option value="full-width"
            {{ old('template', $page->template ?? '') === 'full-width' ? 'selected' : '' }}>
            Full Width
        </option>

        <option value="landing"
            {{ old('template', $page->template ?? '') === 'landing' ? 'selected' : '' }}>
            Landing Page
        </option>

    </select>

    @error('template')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Status --}}
<div class="mb-3">

    <label for="status" class="form-label">
        Status
        <span class="text-danger">*</span>
    </label>

    <select id="status"
            name="status"
            class="form-select @error('status') is-invalid @enderror">

        <option value="1"
            {{ old('status', $page->status ?? 1) == 1 ? 'selected' : '' }}>
            Active
        </option>

        <option value="0"
            {{ old('status', $page->status ?? 1) == 0 ? 'selected' : '' }}>
            Inactive
        </option>

    </select>

    @error('status')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Display Order --}}
<div class="mb-3">

    <label for="display_order" class="form-label">
        Display Order
    </label>

    <input type="number"
           id="display_order"
           name="display_order"
           class="form-control @error('display_order') is-invalid @enderror"
           value="{{ old('display_order', $page->display_order ?? 0) }}"
           min="0">

    @error('display_order')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Featured Image --}}
<div class="mb-3">

    <label for="featured_image" class="form-label">
        Featured Image
    </label>

    @if(isset($page) && $page->featured_image)

        <div class="mb-3">

            <img src="{{ asset('storage/' . $page->featured_image) }}"
                 alt="{{ $page->title }}"
                 class="img-fluid rounded border"
                 style="max-height: 220px;">

        </div>

        <div class="form-text mb-2">
            Upload a new image to replace the current image.
        </div>

    @endif

    <input type="file"
           id="featured_image"
           name="featured_image"
           class="form-control @error('featured_image') is-invalid @enderror"
           accept="image/jpeg,image/png,image/webp">

    <div class="form-text">
        JPG, PNG or WEBP. Maximum size: 2MB.
    </div>

    @error('featured_image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>


{{-- Image Preview --}}
<div class="mt-3 d-none" id="imagePreviewWrapper">

    <img id="imagePreview"
         src="#"
         alt="Image Preview"
         class="img-fluid rounded border"
         style="max-height: 220px;">

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('featured_image');
    const previewWrapper = document.getElementById('imagePreviewWrapper');
    const preview = document.getElementById('imagePreview');

    if (!imageInput) {
        return;
    }

    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {

            previewWrapper.classList.add('d-none');
            preview.src = '#';

            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            preview.src = e.target.result;
            previewWrapper.classList.remove('d-none');

        };

        reader.readAsDataURL(file);

    });

});

</script>
```
