
window._ = require('lodash');
// window.Popper = require('popper.js').default;

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    window.moment = require('moment');
    window.alertify = require('alertifyjs');
    // require('datatables');
} catch (e) {}

window.axios = require('axios');
window.refreshToken = axios.create()

require('./http')


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'
//
// window.io = require('socket.io-client');
//
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: '//localhost' + ':6001',
//     auth: {
//         headers: {
//             'Authorization': `Bearer ${chatStore.token}`
//         }
//     }
// });
