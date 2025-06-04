import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Popper
import * as Popper from '@popperjs/core';
window.Popper = Popper;

import 'bootstrap'; // Importa todo el JavaScript de Bootstrap
