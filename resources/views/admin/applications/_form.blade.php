@php
    $app = $application ?? null;
    $currentColor = old('theme_color', $app?->theme_color ?? '#E9D5FF');
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-7 space-y-5 sm:space-y-6">
    <div>
        <label for="name" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Name <span
                class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $app?->name) }}" required maxlength="50"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('name') border-red-300 @enderror">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Description</label>
        <input type="text" id="description" name="description" value="{{ old('description', $app?->description) }}"
            maxlength="100"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('description') border-red-300 @enderror">
        @error('description')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tags" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Tags</label>
        <select id="tags" name="tags[]" multiple autocomplete="off" class="w-full">
            <option value="">Cari dan pilih tag...</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $app ? $app->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        @error('tags')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 sm:gap-6">
            <div class="sm:col-span-3">
                <label for="app_url" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">App URL <span
                        class="text-red-500">*</span></label>
                <input type="url" id="app_url" name="app_url" value="{{ old('app_url', $app?->app_url) }}" required
                    placeholder="https://example.com"
                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('app_url') border-red-300 @enderror">
                @error('app_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="sort_order" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Urutan</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $app?->sort_order ?? 0) }}"
                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('sort_order') border-red-300 @enderror">
                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <p class="mt-2 text-xs text-gray-400 flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Angka lebih kecil tampil lebih dulu (0, 1, 2, ...)
        </p>
    </div>

    <div class="lg:col-span-5 space-y-6 sm:space-y-8">
    <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm transition-all duration-300">
        <label for="theme_color" class="block text-sm sm:text-base font-medium text-gray-700 mb-3">Theme Color <span
                class="text-red-500">*</span></label>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
            <div class="flex items-start gap-4">
                <div class="relative">
                    <input type="color" id="color_picker" value="{{ $currentColor }}"
                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl cursor-pointer border-2 border-gray-200 hover:border-gray-400 transition-all shadow-inner hover:scale-105 p-1"
                        onchange="updateColor(this.value)">
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-2">Klik untuk pilih warna</p>
                    <div class="flex items-center gap-2 mb-2">
                        <input type="text" id="theme_color" name="theme_color" value="{{ $currentColor }}" required
                            pattern="^#[0-9A-Fa-f]{6}$" maxlength="7"
                            class="w-28 px-3 py-2 bg-gray-50 border-none rounded-lg text-base font-mono focus:ring-2 focus:ring-amber-400 outline-none @error('theme_color') border-red-300 @enderror"
                            onchange="syncColorPicker(this.value)">
                    </div>
                    <p class="text-xs sm:text-sm text-gray-500">Format: #RRGGBB</p>
                </div>
            </div>

        </div>
        @error('theme_color')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="bg-white p-6 rounded-3xl border border-gray-200 shadow-sm transition-all duration-300">
        <label class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Image</label>
        @if($app?->image_url)
            <div class="mb-3 p-4 bg-gray-50 rounded-xl inline-block">
                <img src="{{ $app->image_url }}" alt="Current image"
                    class="w-16 h-16 sm:w-20 sm:h-20 object-contain rounded-lg">
                <p class="text-xs text-gray-500 mt-2">Current image</p>
            </div>
        @endif
        <div class="relative">
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-amber-400 outline-none file:mr-3 file:py-1.5 file:px-3 sm:file:py-2 sm:file:px-4 file:rounded-lg file:border-0 file:bg-amber-100 file:text-amber-800 file:font-medium file:text-sm hover:file:bg-amber-200 transition-all @error('image') border-red-300 @enderror">
        </div>
        <p class="mt-1 text-xs sm:text-sm text-gray-500">PNG, JPG, GIF, SVG, WebP up to 2MB</p>
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new TomSelect('#tags', {
                plugins: ['remove_button'],
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });

        function updateColor(color) {
            document.getElementById('theme_color').value = color;
        }

        function syncColorPicker(color) {
            if (/^#[0-9A-Fa-f]{6}$/.test(color)) {
                document.getElementById('color_picker').value = color;
            }
        }
    </script>
@endpush