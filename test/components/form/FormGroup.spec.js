import { mount } from '@vue/test-utils'
import FormGroup from '@/components/form/FormGroup'
import FormError from '@/components/form/FormError'

test('shows label', () => {
  const wrapper = mount(FormGroup, {
    propsData: {
      label: 'Input 1',
    },
  })

  expect(wrapper.find('label')).toBeTruthy()
  expect(wrapper.find('label').text()).toBe('Input 1')
})

test('does not show error if errors is empty', () => {
  const wrapper = mount(FormGroup, {
    propsData: {
      label: 'Input 1',
      errors: [],
    },
  })

  expect(wrapper.findComponent(FormError).element).toBeFalsy()
})

test('shows error if errors is not empty', () => {
  const wrapper = mount(FormGroup, {
    propsData: {
      label: 'Input 1',
      errors: ['This field is required.'],
    },
  })

  expect(wrapper.findComponent(FormError).element).toBeTruthy()
  expect(wrapper.findComponent(FormError).props().error).toBe('This field is required.')
})
