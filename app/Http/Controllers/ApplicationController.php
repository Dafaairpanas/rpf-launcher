<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Tag;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tagId = $request->input('tag_id');
        $sort = $request->input('sort', 'default');

        $cacheKey = 'welcome_apps_' . md5($search . $tagId . $sort);
        
        $data = \Illuminate\Support\Facades\Cache::remember($cacheKey, 3600, function () use ($search, $tagId, $sort) {
            return [
                'applications' => Application::with('tags')
                    ->when($search, function ($query, $search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->when($tagId, function ($query, $tagId) {
                        return $query->whereHas('tags', function ($q) use ($tagId) {
                            $q->where('tags.id', $tagId);
                        });
                    })
                    ->when($sort, function ($query, $sort) {
                        if ($sort === 'az') return $query->orderBy('name', 'asc');
                        if ($sort === 'za') return $query->orderBy('name', 'desc');
                        if ($sort === 'newest') return $query->latest();
                        if ($sort === 'oldest') return $query->oldest();
                        return $query->orderBy('sort_order', 'asc')->latest();
                    })
                    ->get(),
                'tags' => Tag::all()
            ];
        });

        $applications = $data['applications'];
        $tags = $data['tags'];

        return view('welcome', compact('applications', 'search', 'tags', 'tagId', 'sort'));
    }
}
