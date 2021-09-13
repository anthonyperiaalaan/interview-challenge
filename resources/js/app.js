import Vue from 'vue'
import App from './App'
import store from './store'

require('./bootstrap')
require('./plugins')

Vue.config.productionTip = false

new Vue({
  render: (h) => h(App),
  store,
}).$mount('#app')
