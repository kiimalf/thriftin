<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120',
        ]);

        $path = $request->file('file')->store('articles/content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }
}
