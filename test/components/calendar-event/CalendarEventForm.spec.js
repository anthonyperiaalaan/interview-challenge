// import { mount, createLocalVue } from '@vue/test-utils'
// import Vuex from 'vuex'
// import { FETCH_EVENTS, SAVE_EVENT } from '@/store/actions'
// import CalendarEventForm from '@/components/calendar-event/CalendarEventForm'
//
// const localVue = createLocalVue()
// localVue.use(Vuex)
//
// const elButtonStub = () => ({
//   render(h) {
//
//   },
// })
//
// describe('CalendarEventForm component', () => {
//   let store
//   let actions
//
//   beforeEach(() => {
//     actions = {
//       [SAVE_EVENT]: jest.fn(),
//       [FETCH_EVENTS]: jest.fn(),
//     }
//     store = new Vuex.Store({
//       actions,
//     })
//   })
//
//   test('calls store save when clicking save button', () => {
//     const wrapper = mount(CalendarEventForm, {
//       localVue,
//       store,
//     })
//
//     expect(wrapper.findComponent())
//   })
// })
