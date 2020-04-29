window.Vue = require('vue');
import Vuetify from "vuetify";
const vuetify = new Vuetify();

Vue.use(Vuetify);
import LandingComponent from "./components/LandingComponent";

const landing = new Vue({
    vuetify,
    components:{
        LandingComponent
    }
}).$mount('#landing');
