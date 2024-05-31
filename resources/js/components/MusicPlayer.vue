<template>
    <div class="music-player">
        <div v-if="songs.length">
            <ul class="song-list">
                <li v-for="(song, index) in songs" :key="index" @click="selectSong(index)" :class="{ active: currentSongIndex === index }">
                    <div>
                        <strong>{{ song.song }}</strong>
                        <div class="song-details">{{ song.artist }}</div>
                    </div>
                    <div class="song-duration">3:16</div> <!-- Placeholder for duration -->
                </li>
            </ul>
            <div class="now-playing">
                {{ currentSong.song }}
            </div>
            <div class="song-details">
                {{ currentSong.artist }}
            </div>
            <div class="progress-bar">
                <div class="time">01:06</div> <!-- Placeholder for current time -->
                <div class="progress">
                    <div class="progress-inner"></div> <!-- Placeholder for progress -->
                </div>
                <div class="time">03:16</div> <!-- Placeholder for total duration -->
            </div>
            <div class="player-controls">
                <button @click="toggleShuffle"><i class="fas fa-random"></i></button>
                <button @click="previousSong"><i class="fas fa-backward"></i></button>
                <button @click="togglePlay"><i :class="isPlaying ? 'fas fa-pause' : 'fas fa-play'"></i></button>
                <button @click="nextSong"><i class="fas fa-forward"></i></button>
                <button @click="toggleRepeat"><i class="fas fa-redo"></i></button>
                <button @click="playRandom" class="random-button"><i class="fas fa-random"></i></button>
            </div>
        </div>
        <div v-else>
            <p>No songs available</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['initialSongs'],
    data() {
        return {
            songs: this.initialSongs,
            currentSongIndex: 0,
            isPlaying: false,
            isShuffle: false,
            isRepeat: false,
            history: [],
            playedSongs: new Set(),
            lastArtist: '',
        };
    },
    computed: {
        currentSong() {
            return this.songs[this.currentSongIndex];
        }
    },
    methods: {
        togglePlay() {
            this.isPlaying = !this.isPlaying;
        },
        previousSong() {
            if (this.history.length > 1) {
                this.history.pop();
                this.currentSongIndex = this.history[this.history.length - 1];
            } else if (this.currentSongIndex > 0) {
                this.currentSongIndex--;
            } else if (this.isRepeat) {
                this.currentSongIndex = this.songs.length - 1;
            }
        },
        nextSong() {
            if (this.currentSongIndex < this.songs.length - 1) {
                this.history.push(this.currentSongIndex);
                this.currentSongIndex++;
            } else if (this.isRepeat) {
                this.currentSongIndex = 0;
            }
        },
        selectSong(index) {
            if (index !== this.currentSongIndex) {
                this.history.push(this.currentSongIndex);
                this.currentSongIndex = index;
                this.isPlaying = false;
                this.lastArtist = this.currentSong.artist;
            }
        },
        toggleShuffle() {
            this.isShuffle = !this.isShuffle;
        },
        toggleRepeat() {
            this.isRepeat = !this.isRepeat;
        },
        playRandom() {
            if (this.playedSongs.size === this.songs.length) {
                this.playedSongs.clear();
            }
            let randomIndex;
            do {
                randomIndex = Math.floor(Math.random() * this.songs.length);
            } while (this.playedSongs.has(this.songs[randomIndex].id) || this.songs[randomIndex].artist === this.lastArtist);
            this.playedSongs.add(this.songs[randomIndex].id);
            this.history.push(this.currentSongIndex);
            this.currentSongIndex = randomIndex;
            this.isPlaying = true;
            this.lastArtist = this.currentSong.artist;
        }
    }
};
</script>
