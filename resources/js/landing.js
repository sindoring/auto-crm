window.Vue = require('vue');
import vuetify from '../plugins/vuetify';
import Vuelidate from 'vuelidate';
const VueInputMask = require('vue-inputmask').default;
import Axios from 'axios';

Vue.prototype.$http = Axios;

Vue.use(VueInputMask);
Vue.use(Vuelidate);
Vue.component('landing-component', require('./components/Layouts/LandingComponent').default);

new Vue({
  vuetify,
}).$mount('#landing');
