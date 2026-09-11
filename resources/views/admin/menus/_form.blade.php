{{-- =========================================================
    MENU TITLE
========================================================= --}}

<div class="row g-3">

    <div class="col-md-8">

        <label for="title" class="form-label">
            Menu Title
            <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="title"
            id="title"
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $menu->title ?? '') }}"
            placeholder="Enter menu title"
            required
        >

        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =====================================================
        LOCATION
    ====================================================== --}}

    <div class="col-md-4">

        <label for="location" class="form-label">
            Menu Location
            <span class="text-danger">*</span>
        </label>

        <select
            name="location"
            id="location"
            class="form-select @error('location') is-invalid @enderror"
            required
        >

            <option value="">
                Select Location
            </option>

            <option value="header"
                {{ old('location', $menu->location ?? 'header') === 'header' ? 'selected' : '' }}>
                Header
            </option>

            <option value="footer"
                {{ old('location', $menu->location ?? '') === 'footer' ? 'selected' : '' }}>
                Footer
            </option>

            <option value="mobile"
                {{ old('location', $menu->location ?? '') === 'mobile' ? 'selected' : '' }}>
                Mobile
            </option>

            <option value="sidebar"
                {{ old('location', $menu->location ?? '') === 'sidebar' ? 'selected' : '' }}>
                Sidebar
            </option>

        </select>

        @error('location')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =====================================================
        MENU TYPE
    ====================================================== --}}

    <div class="col-md-4">

        <label for="type" class="form-label">
            Menu Type
            <span class="text-danger">*</span>
        </label>

        <select
            name="type"
            id="type"
            class="form-select @error('type') is-invalid @enderror"
            required
        >

            <option value="">
                Select Type
            </option>

            <option value="page"
                {{ old('type', $menu->type ?? 'page') === 'page' ? 'selected' : '' }}>
                Page
            </option>

            <option value="custom_url"
                {{ old('type', $menu->type ?? '') === 'custom_url' ? 'selected' : '' }}>
                Custom URL
            </option>

            <option value="external_url"
                {{ old('type', $menu->type ?? '') === 'external_url' ? 'selected' : '' }}>
                External URL
            </option>

        </select>

        @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =====================================================
        PAGE SELECTION
    ====================================================== --}}

    <div
        class="col-md-8"
        id="page-field"
    >

        <label for="page_id" class="form-label">
            Select Page
        </label>

        <select
            name="page_id"
            id="page_id"
            class="form-select @error('page_id') is-invalid @enderror"
        >

            <option value="">
                Select Page
            </option>

            @foreach($pages as $page)

                <option
                    value="{{ $page->id }}"
                    {{ (string) old('page_id', $menu->page_id ?? '') === (string) $page->id ? 'selected' : '' }}
                >
                    {{ $page->title }}
                </option>

            @endforeach

        </select>

        @error('page_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =====================================================
        URL
    ====================================================== --}}

    <div
        class="col-md-8"
        id="url-field"
    >

        <label for="url" class="form-label">
            URL
        </label>

        <input
            type="text"
            name="url"
            id="url"
            class="form-control @error('url') is-invalid @enderror"
            value="{{ old('url', $menu->url ?? '') }}"
            placeholder="/about-us or https://example.com"
        >

        @error('url')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="form-text">
            Use an internal path for Custom URL or a complete URL for External URL.
        </div>

    </div>


    {{-- =====================================================
        PARENT MENU
    ====================================================== --}}

    <div class="col-md-4">

        <label for="parent_id" class="form-label">
            Parent Menu
        </label>

        <select
            name="parent_id"
            id="parent_id"
            class="form-select @error('parent_id') is-invalid @enderror"
        >

            <option value="">
                None (Top Level)
            </option>

            @foreach($parents as $parent)

                <option
                    value="{{ $parent->id }}"
                    {{ (string) old('parent_id', $menu->parent_id ?? '') === (string) $parent->id ? 'selected' : '' }}
                >
                    {{ $parent->title }}
                </option>

            @endforeach

        </select>

        @error('parent_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="form-text">
            Select a parent to create a submenu item.
        </div>

    </div>


    {{-- =====================================================
        ICON
    ====================================================== --}}

    <div class="col-md-4">

        <label for="icon" class="form-label">
            Icon
        </label>

        <input
            type="text"
            name="icon"
            id="icon"
            class="form-control @error('icon') is-invalid @enderror"
            value="{{ old('icon', $menu->icon ?? '') }}"
            placeholder="bi bi-house"
        >

        @error('icon')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="form-text">
            Example: <code>bi bi-house</code>
        </div>

    </div>


    {{-- =====================================================
        TARGET
    ====================================================== --}}

    <div class="col-md-4">

        <label for="target" class="form-label">
            Link Target
            <span class="text-danger">*</span>
        </label>

        <select
            name="target"
            id="target"
            class="form-select @error('target') is-invalid @enderror"
            required
        >

            <option value="_self"
                {{ old('target', $menu->target ?? '_self') === '_self' ? 'selected' : '' }}>
                Same Tab
            </option>

            <option value="_blank"
                {{ old('target', $menu->target ?? '') === '_blank' ? 'selected' : '' }}>
                New Tab
            </option>

        </select>

        @error('target')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- =====================================================
        DISPLAY ORDER
    ====================================================== --}}

    <div class="col-md-4">

        <label for="display_order" class="form-label">
            Display Order
        </label>

        <input
            type="number"
            name="display_order"
            id="display_order"
            class="form-control @error('display_order') is-invalid @enderror"
            value="{{ old('display_order', $menu->display_order ?? 0) }}"
            min="0"
        >

        @error('display_order')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        <div class="form-text">
            Lower numbers appear first.
        </div>

    </div>


    {{-- =====================================================
        STATUS
    ====================================================== --}}

    <div class="col-md-4">

        <label for="status" class="form-label">
            Status
        </label>

        <select
            name="status"
            id="status"
            class="form-select @error('status') is-invalid @enderror"
        >

            <option value="1"
                {{ old('status', isset($menu) ? (int) $menu->status : 1) == 1 ? 'selected' : '' }}>
                Active
            </option>

            <option value="0"
                {{ old('status', isset($menu) ? (int) $menu->status : 1) == 0 ? 'selected' : '' }}>
                Inactive
            </option>

        </select>

        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>


{{-- =========================================================
    JAVASCRIPT
    Show Page field only for Page type.
    Show URL field for Custom / External URL.
========================================================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    const typeField = document.getElementById('type');
    const pageField = document.getElementById('page-field');
    const urlField = document.getElementById('url-field');
    const pageSelect = document.getElementById('page_id');
    const urlInput = document.getElementById('url');

    function updateMenuTypeFields() {

        const type = typeField.value;

        if (type === 'page') {

            pageField.style.display = '';
            urlField.style.display = 'none';

            pageSelect.disabled = false;
            urlInput.disabled = true;

        } else if (
            type === 'custom_url' ||
            type === 'external_url'
        ) {

            pageField.style.display = 'none';
            urlField.style.display = '';

            pageSelect.disabled = true;
            urlInput.disabled = false;

        } else {

            pageField.style.display = 'none';
            urlField.style.display = 'none';

            pageSelect.disabled = true;
            urlInput.disabled = true;
        }
    }

    typeField.addEventListener('change', updateMenuTypeFields);

    updateMenuTypeFields();

});
</script>
