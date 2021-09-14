import Vue from 'vue'
import {
  DatePicker,
  Button,
  Notification,
} from 'element-ui'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'

locale.use(lang)
Vue.component(DatePicker.name, DatePicker)
Vue.component(Button.name, Button)

Vue.prototype.$notify = Notification
