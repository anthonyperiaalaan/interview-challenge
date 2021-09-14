import axios from 'axios'
import { SET_EVENTS, SET_FETCHING_EVENTS, SET_SAVING_EVENT } from '@/store/mutations'

export const SAVE_EVENT = 'saveEvent'
export const FETCH_EVENTS = 'fetchEvents'

export default {
  async [SAVE_EVENT]({ commit, state: { eventForm } }) {
    commit(SET_SAVING_EVENT, true)
    try {
      const { data } = await axios.post('/web-api/calendar-event?delete-existing=1', eventForm)

      return data.data
    } finally {
      commit(SET_SAVING_EVENT, false)
    }
  },
  async [FETCH_EVENTS]({ commit }) {
    commit(SET_FETCHING_EVENTS, true)
    try {
      const { data } = await axios.get('/web-api/calendar-event')
      commit(SET_EVENTS, data.data)

      return data.data
    } finally {
      commit(SET_FETCHING_EVENTS, false)
    }
  },
}
