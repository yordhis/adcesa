import axios from 'axios';
window.axios = axios;
import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Popper
import * as Popper from '@popperjs/core';
window.Popper = Popper;

import 'bootstrap'; // Importa todo el JavaScript de Bootstrap
