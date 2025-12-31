<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::latest()->get();
        return view('admin.applications.index', compact('applications'));
    }

    public function create()
    {
        return view('admin.applications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:100',
            'app_url' => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'theme_color' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('apps', 'public');
        }

        Application::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'app_url' => $validated['app_url'],
            'image_url' => $imagePath ? Storage::url($imagePath) : null,
            'theme_color' => $validated['theme_color'],
        ]);

        return redirect()->route('admin.applications.index')
            ->with('success', 'Aplikasi berhasil ditambahkan!');
    }

    public function edit(Application $application)
    {
        return view('admin.applications.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'name' => 'required|max:50',
            'description' => 'required|max:100',
            'app_url' => 'required|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'theme_color' => 'required',
        ]);

        $imagePath = $application->image_url;

        if ($request->hasFile('image')) {
            if ($application->image_url && str_starts_with($application->image_url, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $application->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            $newPath = $request->file('image')->store('apps', 'public');
            $imagePath = Storage::url($newPath);
        }

        $application->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'app_url' => $validated['app_url'],
            'image_url' => $imagePath,
            'theme_color' => $validated['theme_color'],
        ]);

        return redirect()->route('admin.applications.index')
            ->with('success', 'Aplikasi berhasil diperbarui!');
    }

    public function destroy(Application $application)
    {
        if ($application->image_url && str_starts_with($application->image_url, '/storage/')) {
            $path = str_replace('/storage/', '', $application->image_url);
            Storage::disk('public')->delete($path);
        }

        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Aplikasi berhasil dihapus!');
    }
}
