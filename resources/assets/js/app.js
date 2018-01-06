window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('thread', require('./components/Thread.vue'));

const app = new Vue({
    el: '#app'
});
