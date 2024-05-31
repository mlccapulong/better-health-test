<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;

class SongsTableSeeder extends Seeder
{
    public function run()
    {
        $playlist = [
            ["artist" => "Ed Sheeran", "song" => "Shape of You"],
            ["artist" => "Billie Eilish", "song" => "Bad Guy"],
            ["artist" => "Post Malone", "song" => "Circles"],
            ["artist" => "Taylor Swift", "song" => "Shake It Off"],
            ["artist" => "The Weeknd", "song" => "Blinding Lights"],
            ["artist" => "Ed Sheeran", "song" => "Photograph"],
            ["artist" => "Adele", "song" => "Rolling in the Deep"],
            ["artist" => "Post Malone", "song" => "Sunflower"],
        ];

        foreach ($playlist as $track) {
            Song::create($track);
        }
    }
}
