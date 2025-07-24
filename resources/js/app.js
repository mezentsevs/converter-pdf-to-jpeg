import './bootstrap';
import Alpine from 'alpinejs';
import Slider from './modules/Slider.js';

window.Alpine = Alpine;
window.Slider = Slider;

Alpine.start();

const loadSlides = async () => {
    await axios.get('/sanctum/csrf-cookie');

    const response = await axios.get('/api/slides');

    if (response.status === 200) { return response.data; }
};

if (window.location.pathname === '/result') {
    loadSlides()
        .then((data) => {
            if (data.success === true) { Slider.slides = data.slides; }

            if (Slider.slides) {
                Slider.init();
                Slider.show();
            }
        });
}
