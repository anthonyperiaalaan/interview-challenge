import { mount } from '@vue/test-utils'
import FormError from '@/components/form/FormError'

test('shows error text', () => {
  const wrapper = mount(FormError, {
    propsData: {
      error: 'This is the test error.',
    },
  })

  expect(wrapper.text()).toContain('This is the test error.')
})

test('shows error text in red', () => {
  const wrapper = mount(FormError, {
    propsData: {
      error: 'This is the test error.',
    },
  })

  expect(wrapper.classes()).toContain('text-red-600')
})
