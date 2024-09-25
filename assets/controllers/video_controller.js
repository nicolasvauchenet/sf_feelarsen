import {Controller} from "@hotwired/stimulus";
import MediaManager from './media_manager.js';

export default class extends Controller {
    connect() {
        if (!this.element.videoPlayer) {
            this.videoPlayer = this.element;

            const videoId = this.element.dataset.videoId;
            this.videoPlayer.src = `/video/stream/${videoId}`;

            this.videoPlayer.addEventListener('play', () => {
                MediaManager.play(this);
            });

            this.videoPlayer.addEventListener('pause', () => {
                MediaManager.pause(this);
            });

            this.element.videoPlayer = this.videoPlayer;
        }
    }

    disconnect() {
        if (this.videoPlayer) {
            this.videoPlayer.pause();
        }
    }

    pause() {
        if (this.videoPlayer) {
            this.videoPlayer.pause();
        }
    }
}
