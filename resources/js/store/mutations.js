import { set } from 'lodash'

export const SET_EVENT_FORM = 'setEventForm'
export const SET_EVENT_FORM_FIELD = 'setEventFormField'
export const SET_SAVING_EVENT = 'setSavingEvent'

export default {
  [SET_EVENT_FORM](state, value) {
    state.eventForm = value
  },
  [SET_EVENT_FORM_FIELD]({ eventForm }, { key, value }) {
    set(eventForm, key, value)
  },
  [SET_SAVING_EVENT](state, value) {
    state.savingEvent = value
  },
}
