window.Vue = require('vue');

Vue.component('thread', require('./components/Thread.vue'));

const app = new Vue({
    el: '#app'
});
