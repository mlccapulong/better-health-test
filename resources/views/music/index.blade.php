@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Playlist</h1>
    <div class="row">
        <div class="col-md-12">
            <music-player :initial-songs="{{ json_encode($songs) }}"></music-player>
        </div>
    </div>
</div>
@endsection
