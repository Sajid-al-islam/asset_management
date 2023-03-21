require('./plugins/axios_setup');
require('./plugins/moment_setup');
require('./plugins/preview_image');
require('./plugins/auto_logout');
require('./plugins/preloader');

window.CsvBuilder = require('filefy').CsvBuilder;
/*********************
   dashboard vue setup
**********************/

import Vue from 'vue'
import router from './router/router';
import { mapGetters } from 'vuex'
import store from './store/index';

Vue.use(router)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.component('ex-app', require('./App.vue').default);
if (document.getElementById('app')) {
    new Vue({
        store,
        router,
        el: '#app',
        created: function () {
            console.log('dashboard started', this.get_check_auth);
            // console.log(this.$store);
        },
        computed: {
            ...mapGetters(['get_check_auth'])
        }
    })
}
