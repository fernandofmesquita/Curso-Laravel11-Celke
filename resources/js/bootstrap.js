// Importar o framework Bootstrap 5
import 'bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;

import Swal from 'sweetalert2';
window.Swal = Swal;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
