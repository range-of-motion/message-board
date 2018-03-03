window.Vue = require('vue');

window.axios = require('axios');

window.moment = require('moment');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

window.pusherKey = document.querySelector('meta[name="pusher-key"]').getAttribute('content');

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: pusherKey,
    cluster: 'eu',
    encrypted: true
});

Vue.component('threads', require('./components/Threads.vue'));
Vue.component('thread', require('./components/Thread.vue'));
Vue.component('thread-composer', require('./components/ThreadComposer.vue'));
Vue.component('comment', require('./components/Comment.vue'));
Vue.component('comment-composer', require('./components/CommentComposer.vue'));

const app = new Vue({
    el: '#app'
});
