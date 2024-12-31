import './bootstrap';
import Alpine from 'alpinejs';
import Slider from './Modules/Slider.js';

window.Alpine = Alpine;
window.Slider = Slider;

Alpine.start();

async function getSlides() {
    await axios.get('/sanctum/csrf-cookie');

    const response = await axios.get('/api/slides');

    return response.data;
}

if (window.location.pathname === '/result') {
    getSlides()
        .then((data) => {
            Slider.slides = data;

            if (Slider.slides) {
                Slider.init();
            }
        });
}
