<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BulkStoreSongRequest;
use App\Http\Requests\StoreSongRequest;
use App\Http\Requests\UpdateSongRequest;
use App\Models\SingerOrder;
use App\Models\Song;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $songs = Song::with('singer')->paginate(20);
        $statistics = [
            "free" => Song::freeSongs()->count(),
            "busy" => Song::busySongs()->count(),
            "all" => Song::count(),
        ];
        return view('admin.song.index', compact('songs', 'statistics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSongRequest $request)
    {
        $data = $request->validated();
        Song::create([
            'name' => $data['name']
        ]);
        return response()->json(['message' => 'Песня успешно добавлена']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function bulk_store(BulkStoreSongRequest $request)
    {
        $data = $request->validated();

        $songs = [];
        foreach ($data['songs'] as $songName) {
            $songs[] = ['name' => $songName];
        }

        Song::insert($songs);

        return response()->json([
            'message' => count($songs) . ' песен успешно добавлено'
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSongRequest $request, Song $song)
    {
        $data = $request->validated();
        $song->update(['name' => $data['name']]);
        return response()->json(['message' => 'Песня изменена успешно']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(['message' => 'Песня удалена успешно']);
    }

    /**
     * Remove all songs from storage.
     */
    public function clear()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        SingerOrder::truncate();
        Song::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return response()->json(['message' => 'Очистка прошла успешно']);
    }
}
