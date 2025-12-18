import './bootstrap';
import Alpine from 'alpinejs';

import DocumentUploadForm from './modules/DocumentUploadForm.js';
import Slider from './modules/Slider.js';
import SlidesLoader from './modules/SlidesLoader.js';
import ThemeToggle from './modules/ThemeToggle.js';

window.Alpine = Alpine;
window.Slider = Slider;

Alpine.data('themeToggle', () => ({
    darkMode: false,

    init() {
        this.darkMode = ThemeToggle.isDark();
    },

    toggleTheme() {
        ThemeToggle.toggleTheme();

        this.darkMode = ThemeToggle.isDark();
    },
}));

Alpine.start();

SlidesLoader.init();
DocumentUploadForm.init();
ThemeToggle.init();
