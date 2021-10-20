import { mount } from '@vue/test-utils'
import FormDateRangeInput from '@/components/form/FormDateRangeInput'

const elDatePickerStub = () => ({
  render(h) {
    return h('div')
  },
  props: ['value', 'placeholder'],
})

describe('FormDateRangeInput', () => {
  let stubs
  beforeEach(() => {
    stubs = {
      'el-date-picker': elDatePickerStub(),
    }
  })

  test('shows el-date-picker', () => {
    const wrapper = mount(FormDateRangeInput, { stubs })

    expect(wrapper.findComponent(stubs['el-date-picker']).element).toBeTruthy()
  })

  test('passes value to el-date-picker', () => {
    const wrapper = mount(FormDateRangeInput, {
      stubs,
      propsData: {
        value: ['1991-01-01', '1991-01-31'],
      },
    })

    expect(wrapper.findComponent(stubs['el-date-picker']).element).toBeTruthy()
    expect(wrapper.findComponent(stubs['el-date-picker']).props('value')).toEqual(['1991-01-01', '1991-01-31'])
  })

  test('emits input if el-date-picker emits input', () => {
    const wrapper = mount(FormDateRangeInput, {
      stubs,
    })

    expect(wrapper.emitted().input).toBeFalsy()
    expect(wrapper.findComponent(stubs['el-date-picker']).element).toBeTruthy()
    wrapper.findComponent(stubs['el-date-picker']).vm.$emit('input', ['1991-01-01', '1991-01-31'])
    expect(wrapper.emitted().input).toBeTruthy()
    expect(wrapper.emitted().input.length).toBe(1)
    expect(wrapper.emitted().input[0]).toEqual([['1991-01-01', '1991-01-31']])
  })

  test('sets placeholder prop of el-date-picker', () => {
    const wrapper = mount(FormDateRangeInput, {
      stubs,
      propsData: {
        placeholder: 'Test Placeholder',
      },
    })

    expect(wrapper.findComponent(stubs['el-date-picker']).element).toBeTruthy()
    expect(wrapper.findComponent(stubs['el-date-picker']).props('placeholder')).toBe('Test Placeholder')
  })
})
