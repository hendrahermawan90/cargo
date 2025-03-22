<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;

class TrackingController extends Controller
{
    public function track(Request $request)
    {
        $tracking_number = $request->input('tracking_number');
        $tracking = Tracking::where('tracking_number', $tracking_number)->first();

        if (!$tracking) {
            return back()->with('error', 'Tracking number not found.');
        }

        return view('tracking.result', [
            'tracking_number' => $tracking->tracking_number,
            'status' => $tracking->status,
            'updated_at' => $tracking->updated_at,
        ]);
    }
}
