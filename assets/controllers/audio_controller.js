import {Controller} from '@hotwired/stimulus';
import MediaManager from './media_manager.js';

export default class extends Controller {
    static targets = ['playButton', 'audioElement', 'trackList'];

    connect() {
        this.currentTrackIndex = null;
        this.tracks = this.trackListTarget.querySelectorAll('li[data-track-id]');
        this.addClickListeners();
        this.loadTrack();
        this.audioElementTarget.addEventListener('ended', () => this.onTrackEnded());
    }

    addClickListeners() {
        this.tracks.forEach((track, index) => {
            track.addEventListener('click', () => this.playTrackByIndex(index));
        });
    }

    loadTrack() {
        if (this.currentTrackIndex !== null) {
            const track = this.tracks[this.currentTrackIndex];
            const trackId = track.dataset.trackId;
            this.audioElementTarget.src = `/track/stream/${trackId}`;
            this.updateTrackSelection();
        }
    }

    togglePlay() {
        if (this.audioElementTarget.paused) {
            this.play();
        } else {
            this.pause();
        }
    }

    play() {
        if (this.currentTrackIndex === null && this.tracks.length > 0) {
            this.currentTrackIndex = 0;
            this.loadTrack();
        }
        MediaManager.play(this);
        this.audioElementTarget.play();
        this.playButtonTarget.classList.add('active');
        this.updateTrackSelection();
    }

    pause() {
        this.audioElementTarget.pause();
        this.playButtonTarget.classList.remove('active');
        this.tracks.forEach(track => track.classList.remove('selected-track'));
        MediaManager.pause(this);
    }

    previous() {
        this.currentTrackIndex = (this.currentTrackIndex - 1 + this.tracks.length) % this.tracks.length;
        this.loadTrack();
        this.playTrackAutomatically();
    }

    next() {
        this.currentTrackIndex = (this.currentTrackIndex + 1) % this.tracks.length;
        this.loadTrack();
        this.playTrackAutomatically();
    }

    playTrackByIndex(index) {
        this.currentTrackIndex = index;
        this.loadTrack();
        this.play();
    }

    playTrackAutomatically() {
        this.play();
    }

    updateTrackSelection() {
        this.tracks.forEach(track => track.classList.remove('selected-track'));
        if (this.currentTrackIndex !== null) {
            this.tracks[this.currentTrackIndex].classList.add('selected-track');
        }
    }

    onTrackEnded() {
        this.next();
    }

    stop() {
        this.audioElementTarget.pause();
        this.audioElementTarget.currentTime = 0;
        this.playButtonTarget.classList.remove('active');
        this.tracks.forEach(track => track.classList.remove('selected-track'));
        this.currentTrackIndex = null;
    }
}
