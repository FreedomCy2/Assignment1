<?php

namespace App\Http\Controllers;

use App\Models\User2;
use Illuminate\Http\Request;

class User2Controller extends Controller
{
    public function index()
    {
        return response()->json(User2::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users2',
        ]);

        $user2 = User2::create($validated);

        return response()->json($user2);
    }

    public function update(Request $request, User2 $user2)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users2,email,' . $user2->id,
        ]);

        $user2->update($validated);

        return response()->json($user2);
    }

    public function destroy(User2 $user2)
    {
        $user2->delete();

        return response()->json(['success' => true]);
    }
}
