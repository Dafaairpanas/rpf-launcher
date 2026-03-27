@extends('layouts.admin')

@section('title', 'Add Tag')
@section('header', 'Add Tag')

@section('header-actions')
    <a href="{{ route('admin.tags.index') }}"
        class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-700 font-medium px-4 py-2 rounded-xl hover:bg-gray-50 transition-all shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali
    </a>
@endsection

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            <form action="{{ route('admin.tags.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Tag <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors @error('name') border-red-500 @enderror"
                        placeholder="Contoh: Komunikasi">
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Warna (Hex)</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="color-picker" value="{{ old('color', '#f59e0b') }}"
                            class="w-10 h-10 rounded cursor-pointer border-0 p-0"
                            onchange="document.getElementById('color').value = this.value">
                        <input type="text" name="color" id="color" value="{{ old('color') }}"
                            class="flex-1 px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-colors"
                            placeholder="#f59e0b">
                    </div>
                    <p class="mt-1.5 text-sm text-gray-500">Opsional. Pilih warna untuk tag.</p>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-6 py-2.5 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
