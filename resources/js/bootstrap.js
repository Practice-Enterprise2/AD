// Default JavaScript for ANY page
import Alpine from 'alpinejs';
import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import $ from 'jquery';
import Chart from 'chart.js/auto';

const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute('content');
const axios_headers = axios.defaults.headers.common;
const echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY ?? 'staging',
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
    encrypted: false,
    auth: {
        headers: {
            'X-CSRF-Token': csrfToken,
        },
    },
});

// Set instances on the window to make them accessible from browser dev tools
window.axios = axios;
window.Pusher = Pusher;
window.Echo = echo;
window.Alpine = Alpine;
window.$ = $;
window.jQuery = $;
window.Chart = Chart;
// Set common Axios request headers
axios_headers['X-CSRF-Token'] = csrfToken;
axios_headers['X-Requested-With'] = 'XMLHttpRequest';

Alpine.start();
