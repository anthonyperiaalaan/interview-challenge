import { set } from 'lodash'

export const SET_EVENT_FORM = 'setEventForm'
export const SET_EVENT_FORM_FIELD = 'setEventFormField'

export default {
  [SET_EVENT_FORM](state, value) {
    state.eventForm = value
  },
  [SET_EVENT_FORM_FIELD]({ eventForm }, { key, value }) {
    set(eventForm, key, value)
  },
}
