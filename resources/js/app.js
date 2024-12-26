import './bootstrap';
import Alpine from 'alpinejs';
import Slider from './Modules/Slider.js';

window.Alpine = Alpine;
window.Slider = Slider;

Alpine.start();

if (typeof slides !== 'undefined') {
    window.addEventListener('load', function () {
        Slider.init();
    });
}
