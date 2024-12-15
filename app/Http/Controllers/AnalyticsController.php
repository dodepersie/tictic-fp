<?php

namespace App\Http\Controllers;

class AnalyticsController extends Controller
{
    public function index()
    {
        $title = 'View Analytics Report';

        return view('dashboard.analytics.index', compact('title'));
    }
}
