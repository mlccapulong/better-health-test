<?php

namespace Tests\Feature;

use App\Models\Song;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MusicPlayerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_songs()
    {
        $user = User::factory()->create();
        $songs = Song::factory()->count(3)->create();

        $response = $this->actingAs($user)->get('/music');
        $response->assertStatus(200);

        foreach ($songs as $song) {
            $response->assertSeeText($song->artist);
            $response->assertSeeText($song->song);
        }
    }

    public function test_user_can_fetch_songs_via_api()
    {
        $songs = Song::factory()->count(3)->create();

        $response = $this->get('/api/songs');
        $response->assertStatus(200);

        $response->assertJsonCount(3);
        foreach ($songs as $song) {
            $response->assertJsonFragment([
                'artist' => $song->artist,
                'song' => $song->song,
            ]);
        }
    }

    public function test_guest_cannot_access_music_page()
    {
        $response = $this->get('/music');
        $response->assertRedirect('/login');
    }
}
