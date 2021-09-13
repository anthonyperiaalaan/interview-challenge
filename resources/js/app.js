import Vue from 'vue'
import App from './App'

require('./bootstrap');

Vue.config.productionTip = false

new Vue({
    render: (h) => h(App),
}).$mount('#app')
