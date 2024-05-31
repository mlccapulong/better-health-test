<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\PlayHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function index()
    {
        $songs = Song::all();
        return view('music.index', compact('songs'));
    }

    public function random()
    {
        $userId = Auth::id();
        $playedSongs = PlayHistory::where('user_id', $userId)
            ->pluck('song_id')
            ->toArray();

        $lastPlayedSong = PlayHistory::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();
        
        if (count($playedSongs) === Song::count()) {
            PlayHistory::where('user_id', $userId)->delete();
            $playedSongs = [];
        }

        $query = Song::whereNotIn('id', $playedSongs);

        if ($lastPlayedSong) {
            $lastPlayedSongArtist = Song::find($lastPlayedSong->song_id)->artist;
            $query->where('artist', '!=', $lastPlayedSongArtist);
        }

        $randomSong = $query->inRandomOrder()->first();

        $this->savePlayHistory($randomSong->id);

        return response()->json($randomSong);
    }

    private function savePlayHistory($songId)
    {
        if (Auth::check()) {
            PlayHistory::create([
                'user_id' => Auth::id(),
                'song_id' => $songId,
            ]);
        }
    }
}

