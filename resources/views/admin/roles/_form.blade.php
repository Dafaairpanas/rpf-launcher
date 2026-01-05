@php
    $role = $role ?? null;
@endphp

<div class="space-y-5 sm:space-y-6">
    <div>
        <label for="name" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Name <span
                class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $role?->name) }}" required maxlength="50"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('name') border-red-300 @enderror">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>