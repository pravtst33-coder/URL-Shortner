<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($short_code)
    {
        $url = \App\Models\ShortUrl::where('short_code', $short_code)->firstOrFail();
        return redirect($url->original_url);
    }
}