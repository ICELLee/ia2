<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Release;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Slides: nur die 5 neusten
        $slides = Slider::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Releases: nur die 8 neusten
        $releases = Release::orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        // Events: nur die 10 kommenden
        $events = Event::with('tags')
            ->orderBy('starts_at', 'desc')
            ->limit(10)
            ->get();

        return view('pages.home.index', compact('slides', 'releases', 'events'));
    }
}
