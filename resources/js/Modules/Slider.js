export default {
    slides: [],
    index: 0,
    set(slide) {
        const $el = document.getElementById('slide');

        if ($el) {
            $el.setAttribute('src', slide);
        }
    },
    init() {
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
    hide() {
        const $el = document.getElementById('slider');

        if ($el) {
            $el.style.display = 'none';
        }
    },
    show() {
        const $el = document.getElementById('slider');

        if ($el) {
            $el.style.display = 'block';
        }
    },
};
