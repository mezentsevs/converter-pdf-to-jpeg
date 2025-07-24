import './bootstrap';
import Alpine from 'alpinejs';
import DocumentUploadForm from './modules/DocumentUploadForm.js';
import Slider from './modules/Slider.js';
import SlidesLoader from './modules/SlidesLoader.js';

window.Alpine = Alpine;
window.Slider = Slider;

Alpine.start();

SlidesLoader.init();
DocumentUploadForm.init();
