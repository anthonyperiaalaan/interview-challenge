import axios from 'axios'
import { SET_SAVING_EVENT } from '@/store/mutations'

export const SAVE_EVENT = 'saveEvent'

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
}
