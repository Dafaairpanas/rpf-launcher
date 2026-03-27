@extends('layouts.admin')

@section('title', 'Add Application')
@section('header', 'Add New Application')

@section('content')
    <div class="w-full">
        <form action="{{ route('admin.applications.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl border border-gray-200 p-6 md:p-8">
            @csrf
            @include('admin.applications._form')

            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.applications.index') }}"
                    class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-600 to-amber-700 text-white font-medium px-6 py-3 rounded-xl hover:from-amber-700 hover:to-amber-800 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Application
                </button>
            </div>
        </form>
    </div>
@endsection
