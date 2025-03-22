<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;

class AdminTrackingController extends Controller
{
    public function index()
    {
        $trackings = Tracking::latest()->paginate(10); // Ambil data tracking terbaru
        return view('admin.tracking.index', compact('trackings'));
    }
}
