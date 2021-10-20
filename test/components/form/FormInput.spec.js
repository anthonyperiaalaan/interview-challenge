import { mount } from '@vue/test-utils'
import FormInput from '@/components/form/FormInput.vue'

test('shows text input', () => {
  const wrapper = mount(FormInput)

  expect(wrapper.find('input[type=text]').exists()).toBe(true)
})

test('shows text content based on value', () => {
  const wrapper = mount(FormInput, {
    propsData: {
      value: 'test value',
    },
  })

  expect(wrapper.find('input').element.value).toBe('test value')
})

test('emits value if value is changed', () => {
  const wrapper = mount(FormInput, {
    propsData: {
      value: null,
    },
  })

  expect(wrapper.emitted().input).toBeFalsy()
  wrapper.find('input').setValue('test')
  expect(wrapper.emitted().input).toBeTruthy()
  expect(wrapper.emitted().input.length).toBe(1)
  expect(wrapper.emitted().input[0]).toEqual(['test'])
})
