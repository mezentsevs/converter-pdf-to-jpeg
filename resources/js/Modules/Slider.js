export default {
    slides: [],
    index: 0,
    set(slide) {
        document.getElementById('slide').setAttribute('src', slide);
    },
    init() {
        this.slides = slides;
        this.set(this.slides[0]);
    },
    prev() {
        this.index--;

        if (this.index < 0) {
            this.index = this.slides.length - 1;
        }

        this.set(this.slides[this.index]);
    },
    next() {
        this.index++;

        if (this.index === this.slides.length) {
            this.index = 0;
        }

        this.set(this.slides[this.index]);
    },
};
