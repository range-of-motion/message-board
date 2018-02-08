window.Vue = require('vue');

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '6a1dde516a953d4d611d',
    cluster: 'eu',
    encrypted: true
});

Vue.component('thread', require('./components/Thread.vue'));
Vue.component('composer', require('./components/Composer.vue'));

const app = new Vue({
    el: '#app',

    data: {
        threads: []
    },

    created() {
        window.Echo.channel('threads').listen('ThreadCreated', (e) => {
            this.threads.unshift({
                created_at: e.created_at.date,
                title: e.title
            })
        })
    }
});
