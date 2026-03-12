<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItineraryController extends Controller
{
    public function index()
    {
        return response()->json(Itinerary::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => "required",
            "duration" => "required|numeric|min:1",
            "image" => "required|url"
        ]);

        $user = Auth::user();

        $itinerary = $user->itineraries()->create($validated);

        return response()->json([
            "message" => "the recored has been created",
            "itinerary" => $itinerary
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
