import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import vuetify from '../plugins/vuetify';
import Vuelidate from 'vuelidate';
import VuetifyToast from 'vuetify-toast-snackbar';
import Axios from 'axios';

import routes from './router';
import apiKey from '../plugins/apiKey';

const apiHost = `http://${window.location.hostname}/api`;
Vue.prototype.$http = Axios;
Vue.prototype.$host = apiHost;

Vue.prototype.$http.defaults.headers.common['Authorization'] = `Bearer ${apiKey}`;

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VuetifyToast, {
  x: 'center',
  y: 'top',
});

Vue.component('crm-layout', require('./components/Layouts/CrmLayout').default);

const router = new VueRouter({
  routes, mode: 'history',
});

new Vue({
  router,
  vuetify,
}).$mount('#app');
