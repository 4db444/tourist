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
            "categories.*" => "string|exists:categories,name",

            "destinations" => "nullable|array",
            "destinations.*.title" => "required|string",
            "destinations.*.description" => "required|string",
            "destinations.*.accomidation" => "required|string",

            "destinations.*.mustTry" => "nullable|array",
            "destinations.*.mustTry.*.title" => "required|string",
            "destinations.*.mustTry.*.type" => "required|in:dish,place,activity",
        ]);

        $user = Auth::user();

        $itinerary = $user->itineraries()->create($validated);

        foreach($validated["categories"] as $category){
            $itinerary->categories()->attach(Category::where("name", $category)->first());
        }

        foreach($validated["destinations"] as $destination){
            $destination_obj = $itinerary->destinations()->create($destination);

            foreach($destination["mustTry"] as $mustTry){
                $destination_obj->must_tries()->create($mustTry);
            } 
        }

        return response()->json([
            "message" => "the recored has been created",
            "itinerary" => $itinerary->load("categories")
        ]);
    }

    public function show(int $id)
    {
        $itinerary = Itinerary::find($id);

        if(!$itinerary) return response()->json([
            "message" => "this Itinerary does not exists !"
        ]);

        $itinerary->load(["destinations", "categories"]);
        foreach($itinerary->destinations as $destination){
            $destination->load("must_tries");
        }

        return response()->json($itinerary);
    }

    public function update(Request $request, int $id)
    {
        $user = Auth::user();
        $itinerary = Itinerary::find($id);

        if($itinerary && $itinerary->owner->id === $user->id){
            $itinerary->categories()->detach();
            $itinerary->destinations()->delete();

            $validated = $request->validate([
                "title" => "required",
                "duration" => "required|numeric|min:1",
                "image" => "required|url",

                "categories" => "nullable|array",
                "categories.*" => "string|exists:categories,name",

                "destinations" => "nullable|array",
                "destinations.*.title" => "required|string",
                "destinations.*.description" => "required|string",
                "destinations.*.accomidation" => "required|string",

                "destinations.*.mustTry" => "nullable|array",
                "destinations.*.mustTry.*.title" => "required|string",
                "destinations.*.mustTry.*.type" => "required|in:dish,place,activity",
            ]);

            $itinerary->update([
                "title" => $validated["title"],
                "duration" => $validated["duration"],
                "image" => $validated["image"],
            ]);

            foreach($validated["categories"] as $category){
                $itinerary->categories()->attach(Category::where("name", $category)->first());
            }

            foreach($validated["destinations"] as $destination){
                $destination_obj = $itinerary->destinations()->create($destination);

                foreach($destination["mustTry"] as $mustTry){
                    $destination_obj->must_tries()->create($mustTry);
                } 
            }

            return response()->json([
                "message" => "the recored has been updated",
                "itinerary" => $itinerary->load("categories")
            ]);
        }

        return response()->json([
            "message" => "you can not update this !"
        ]);
    }

    public function destroy(int $id)
    {
        $itinerary = Itinerary::find($id);
        if($itinerary && $itinerary->owner->id === Auth::user()->id){
            $itinerary->delete();
            return response()->json([
                "message" => "the record has been deleted successfully"
            ]);
        }
        return response()->json([
            "message" => "you can not delete this !"
        ]);
    }
}
