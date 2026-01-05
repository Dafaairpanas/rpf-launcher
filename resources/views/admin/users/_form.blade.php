@php
    $user = $user ?? null;
    $isEdit = isset($user);
@endphp

<div class="space-y-5 sm:space-y-6">
    <div>
        <label for="name" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Name <span
                class="text-red-500">*</span></label>
        <input type="text" id="name" name="name" value="{{ old('name', $user?->name) }}" required maxlength="100"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('name') border-red-300 @enderror">
        @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="email" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Email <span
                class="text-red-500">*</span></label>
        <input type="email" id="email" name="email" value="{{ old('email', $user?->email) }}" required maxlength="255"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('email') border-red-300 @enderror">
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role_id" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">Role</label>
        <select id="role_id" name="role_id"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('role_id') border-red-300 @enderror">
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id', $user?->role_id) == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        @error('role_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="password" class="block text-sm sm:text-base font-medium text-gray-700 mb-2">
            Password @if(!$isEdit)<span class="text-red-500">*</span>@endif
        </label>
        <input type="password" id="password" name="password" {{ !$isEdit ? 'required' : '' }} minlength="8"
            class="w-full px-3 sm:px-4 py-2.5 sm:py-3 text-base border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-400 focus:border-transparent transition-all outline-none @error('password') border-red-300 @enderror">
        @if(!$isEdit)
            <p class="mt-1 text-xs sm:text-sm text-gray-500">Password minimal 8 karakter</p>
        @else
            <p class="mt-1 text-xs sm:text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah password</p>
        @endif
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>