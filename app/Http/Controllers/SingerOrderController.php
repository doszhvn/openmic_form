<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSingerOrderRequest;
use App\Models\SingerOrder;
use App\Models\Song;

class SingerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::freeSongs()->get();
        return view('singer_form.index', compact('songs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSingerOrderRequest $request)
    {
        $data = $request->validated();
        $song = Song::whereId($data['song_id'])->with('singer')->first();

        if($song['singer'] instanceof SingerOrder) {
            return response()->json(['message' => 'Песня уже занята! Выберите другую песню'], 409);
        }

        if(SingerOrder::where('instagram', $data['instagram'])->exists()) {
            return response()->json(['message' => 'Вы уже зарегистрировались'], 400);
        }

        SingerOrder::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'instagram' => $data['instagram'],
            'song_id' => $data['song_id'],
        ]);
        return response()->json(['message' => "Вы успешно зарегистрировались! Ваша песня {$song['name']}"]);
    }
}
