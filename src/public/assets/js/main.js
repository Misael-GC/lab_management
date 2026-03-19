// assets/js/app.js
import { initNavbar } from './components/scripts.js';
import { initVideoHome } from './components/video.js';
import { initDarkMode } from './components/darkmode.js';

window.addEventListener('DOMContentLoaded', () => {
    initNavbar();
    initVideoHome();
    initDarkMode();
});