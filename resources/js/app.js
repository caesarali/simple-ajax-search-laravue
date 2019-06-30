require('./bootstrap');

window.Vue = require('vue');

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

Vue.filter("number", function (value) {
    return new Intl.NumberFormat('nl-NL').format(value);
})

// const app = new Vue({
//     el: '#app',
// });
