export default class MediaManager {
    static activeMedia = null;

    static play(mediaInstance) {
        if (this.activeMedia && this.activeMedia !== mediaInstance) {
            this.activeMedia.pause();
        }
        this.activeMedia = mediaInstance;
    }

    static pause(mediaInstance) {
        if (this.activeMedia === mediaInstance) {
            this.activeMedia = null;
        }
    }
}
