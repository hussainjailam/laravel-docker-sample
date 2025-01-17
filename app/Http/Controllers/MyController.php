<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello World'
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        // Save to database

        return response()->json([
            'message' => "User {$request->name} created!"
        ], 201);
    }
}
