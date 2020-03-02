require('./bootstrap');

import Vue from 'vue';
import axios from 'axios';

import store from './store/index';
import Translator from './plugins/Translator';

import Components from './components';

Vue.use(Translator);

if (document.getElementById('v-app')) {
    if (window.core_project) {
        axios.defaults.headers.common = {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': window.core_project.csrfToken || '',
            'Accept-Language': window.core_project.locale,
        };
    } else {
        console.log('No window.core_project! You\'re probably testing static components');
    }
    window.vm = new Vue({
        el: '#v-app',
        components: { ...Components },
        store,
    });
}

// const app = new Vue({
//     el: '#v-app',
//     store,
// });//.$mount('#app');


