<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $urls = collect();
        $members = collect();

        if ($user->role_id === 1) { // SuperAdmin
            $urls = \App\Models\ShortUrl::with('company', 'user')->latest()->paginate(5);
        } elseif ($user->role_id === 2) { // Admin
            $urls = \App\Models\ShortUrl::where('company_id', $user->company_id)->with('user')->latest()->paginate(5);
            $members = \App\Models\User::where('company_id', $user->company_id)->with('role')->get();
        } else { // Member
            $urls = \App\Models\ShortUrl::where('user_id', $user->id)->latest()->paginate(5);
        }

        return view('dashboard', compact('urls', 'members'));
    }
}
