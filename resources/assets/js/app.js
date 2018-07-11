
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import * as VueGoogleMaps from "vue2-google-maps";

Vue.mixin({
    methods: {
        route: route
    }
});

Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyDPXifde3JHcMgh-1fdlrrOMCKC23Klfmc",
        libraries: "places" // necessary for places input
    }
});

import VoterList from './pages/voters/VoterList';
import VoterMap from "./pages/voters/VoterMap";
import VoterDetail from "./pages/voters/VoterDetail";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(VoterList.name, VoterList);
Vue.component(VoterMap.name, VoterMap);
Vue.component(VoterDetail.name, VoterDetail);


const app = new Vue({
    el: '#app',
});
