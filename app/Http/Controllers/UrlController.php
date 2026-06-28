<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function store(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();
        if ($user->role_id === 1) {
            abort(403, 'SuperAdmins cannot create short URLs.');
        }

        $request->validate([
            'original_url' => 'required|url'
        ]);

        $url = \App\Models\ShortUrl::firstOrCreate(
            [
                'original_url' => $request->original_url,
                'company_id' => $user->company_id,
            ],
            [
                'short_code' => \Illuminate\Support\Str::random(6),
                'user_id' => $user->id,
            ]
        );

        return back()->with('success', 'Short URL ready: ' . url($url->short_code));
    }
}