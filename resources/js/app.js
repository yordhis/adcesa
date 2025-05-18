// import './bootstrap';
import 'bootstrap'; // Importa Bootstrap
import '../sass/app.scss'; // Importa tus estilos Sass
import '../css/app.css';
import '../css/style.css';

import.meta.glob([
    '../images/**',
]);

import $ from 'jquery';
  window.$ = $;
import 'jquery-confirm';
import 'jquery-confirm/dist/jquery-confirm.min.css';
import './main.js'; 