<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class UploadController extends Controller
{
    protected function upload(Request $request)
    {
        $filename = Carbon::Now()->timestamp . '_' . $request->image->getClientOriginalName();
        $request->image->storeAs('public', $filename);

        return response()->json([
            'success' => true,
            'message' => 'image uploaded',
            'image' => env('APP_URL') . '/storage/' . $filename
        ]);
    }
}
