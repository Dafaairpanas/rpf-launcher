@php
    $app = $application ?? null;
    $currentColor = old('theme_color', $app?->theme_color ?? '#E9D5FF');
@endphp

<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name <span
                class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $app?->name) }}" required maxlength="50"
            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('name') border-red-300 @enderror">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description <span
                class="text-red-500">*</span></label>
        <input type="text" id="description" name="description" value="{{ old('description', $app?->description) }}"
            required maxlength="100"
            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('description') border-red-300 @enderror">
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="app_url" class="block text-sm font-medium text-gray-700 mb-2">App URL <span
                class="text-red-500">*</span></label>
        <input type="url" id="app_url" name="app_url" value="{{ old('app_url', $app?->app_url) }}" required
            placeholder="https://example.com"
            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('app_url') border-red-300 @enderror">
        @error('app_url')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="theme_color" class="block text-sm font-medium text-gray-700 mb-3">Theme Color <span
                class="text-red-500">*</span></label>
        <div class="flex flex-col sm:flex-row gap-6">
            <div class="flex items-start gap-4">
                <div class="relative">
                    <input type="color" id="color_picker" value="{{ $currentColor }}"
                        class="w-20 h-20 rounded-2xl cursor-pointer border-2 border-gray-200 hover:border-gray-400 transition-all shadow-inner hover:scale-105 p-1"
                        onchange="updateColor(this.value)">
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">Klik untuk pilih warna</p>
                    <div class="flex items-center gap-2 mb-2">
                        <input type="text" id="theme_color" name="theme_color" value="{{ $currentColor }}" required
                            pattern="^#[0-9A-Fa-f]{6}$" maxlength="7"
                            class="w-28 px-3 py-2 border border-gray-200 rounded-lg text-sm font-mono focus:ring-2 focus:ring-amber-400 focus:border-transparent outline-none @error('theme_color') border-red-300 @enderror"
                            onchange="syncColorPicker(this.value)">
                    </div>
                    <p class="text-xs text-gray-500">Format: #RRGGBB</p>
                </div>
            </div>

        </div>
        @error('theme_color')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
        @if($app?->image_url)
            <div class="mb-3 p-4 bg-gray-50 rounded-xl inline-block">
                <img src="{{ $app->image_url }}" alt="Current image" class="w-20 h-20 object-contain rounded-lg">
                <p class="text-xs text-gray-500 mt-2">Current image</p>
            </div>
        @endif
        <div class="relative">
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-amber-50 file:text-amber-700 file:font-medium hover:file:bg-amber-100 @error('image') border-red-300 @enderror">
        </div>
        <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF, SVG, WebP up to 2MB</p>
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

@push('scripts')
    <script>
        function updateColor(color) {
            document.getElementById('theme_color').value = color;
            document.getElementById('preview-top').style.backgroundColor = color;
        }

        function syncColorPicker(color) {
            if (/^#[0-9A-Fa-f]{6}$/.test(color)) {
                document.getElementById('color_picker').value = color;
                document.getElementById('preview-top').style.backgroundColor = color;
            }
        }
    </script>
@endpush
