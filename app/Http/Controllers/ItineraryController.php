<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

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
            "image" => "required|url",
            "categories" => "nullable|array",
            "categories.*" => "string|exists:categories,name"
        ]);

        $user = Auth::user();

        $itinerary = $user->itineraries()->create($validated);

        foreach($validated["categories"] as $category){
            $itinerary->categories()->attach(Category::where("name", $category)->first());
        }

        return response()->json([
            "message" => "the recored has been created",
            "itinerary" => $itinerary->load("categories")
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
