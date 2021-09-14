import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex)

export const newEventForm = () => ({
  title: null,
  start_date: null,
  end_date: null,
  days: [],
})

export default new Vuex.Store({
  state: {
    eventForm: newEventForm(),
    savingEvent: false,
  },
  mutations,
  actions,
})
