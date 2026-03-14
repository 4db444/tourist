<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return response()->json($user->favorites);
    }

    public function store(Request $request, int $id)
    {
        $user = Auth::user();
        $itinerary = Itinerary::find($id);

        if($itinerary){
            $user->favorites()->syncWithoutDetaching($itinerary);
        }

        return response()->json([
            "message" => "itinerary is added to your favorites with success !"
        ]);
    }

    public function destroy(int $id)
    {
        $user = Auth::user();
        $itinerary = Itinerary::find($id);

        if($itinerary){
            $user->favorites()->detach($itinerary);
        }

        return response()->json([
            "message" => "itinerary is removed from your favorites with success !"
        ]);
    }
}
