window.Vue = require('vue');
import Vuetify from "vuetify";
const vuetify = new Vuetify();

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    vuetify,
}).$mount('#app');