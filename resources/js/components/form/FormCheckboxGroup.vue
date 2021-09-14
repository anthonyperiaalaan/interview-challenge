<template>
  <div class="mt-1 space-x-2">
    <label
      v-for="option in options"
      :key="option[valueKey]"
      class="inline-flex cursor-pointer items-center"
      >
      <input
        :id="`checkbox-${option}`"
        type="checkbox"
        class="form-checkbox rounded text-gray-800 ml-1 w-5 h-5 input-transition"
        :checked="isOptionChecked(option)"
        @change="onChangeInput(option, $event)"
        >
      <span class="ml-2 text-sm text-gray-700">
        {{ option[labelKey] }}
      </span>
    </label>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Array,
      default: () => [],
    },
    options: {
      type: Array,
      default: () => [],
    },
    valueKey: {
      type: String,
      default: 'value',
    },
    labelKey: {
      type: String,
      default: 'label',
    },
  },
  methods: {
    getOptionValue(option) {
      return option[this.valueKey]
    },
    onChangeInput(option, e) {
      const { checked } = e.target
      const optionValue = this.getOptionValue(option)

      const newValue = [...this.value]
      if (checked) {
        newValue.push(optionValue)
      } else {
        newValue.splice(this.value.indexOf(optionValue), 1)
      }

      this.$emit('input', newValue)
    },
    isOptionChecked(option) {
      return this.value.includes(this.getOptionValue(option))
    },
  },
}
</script>
