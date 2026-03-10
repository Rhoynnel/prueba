import axios from 'axios';
window.axios = axios;

// pull CSRF token from meta and set header for AJAX requests
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: check that <meta name="csrf-token" /> is present.');
}

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
