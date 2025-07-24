export default {
    init() {
        if (window.location.pathname === '/result') {
            this.loadSlides();
        }
    },
    async loadSlides() {
        await axios.get('/sanctum/csrf-cookie');

        const response = await axios.get('/api/slides');

        if (response.status === 200) {
            const data = response.data;
            if (data.success === true) {
                Slider.slides = data.slides;
            }

            if (Slider.slides) {
                Slider.init();
                Slider.show();
            }
        }
    },
}
