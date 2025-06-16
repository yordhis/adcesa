// Importa Bootstrap.js
import 'bootstrap'; 

// Importa el JavaScript de Bootstrap
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import '../css/style.css';
import './insumo.js'; 
import './productos.js';
import './utils/reset-filtro.js'
import './main.js'; 
import.meta.glob([
    '../images/**',
]);

import $ from 'jquery';
  window.$ = $;
import 'jquery-confirm';
import 'jquery-confirm/dist/jquery-confirm.min.css';

