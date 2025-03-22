<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking; // Sesuaikan dengan model yang digunakan

class ReportController extends Controller
{
    public function index()
    {
        $reports = Tracking::all(); // Ambil semua data dari tabel trackings
        return view('reports.index', compact('reports'));
    }
}
