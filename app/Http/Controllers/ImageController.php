<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Import your Model

class ImageController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate the input
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Handle the file upload
        if ($request->hasFile('photo')) {
            // This saves to storage/app/public/images
            $path = $request->file('photo')->store('images', 'public');

            // 3. Save the path string to the database
            Post::create([
                'image_path' => $path,
            ]);
        }

        return back()->with('success', 'Image uploaded!');
    }
}
