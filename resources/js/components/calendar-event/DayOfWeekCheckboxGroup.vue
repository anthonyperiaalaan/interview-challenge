<template>
  <FormCheckboxGroup
    :value="value"
    :options="options"
    @input="$emit('input', $event)"
    />
</template>

<script>
import FormCheckboxGroup from '../form/FormCheckboxGroup'
import { daysOfWeek } from '@/utils/date'

export default {
  components: { FormCheckboxGroup },
  props: {
    value: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    options: () => daysOfWeek,
  },
}
</script>
