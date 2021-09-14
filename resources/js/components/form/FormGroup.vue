<template>
  <div class="mb-2">
    <label>{{ label }}</label>
    <slot />
    <FormError
      v-if="errors.length"
      class="mt-1"
      :error="errors[0]"
      />
  </div>
</template>

<script>
import FormError from '@/components/form/FormError'

export default {
  components: { FormError },
  props: {
    label: {
      type: String,
      default: null,
    },
    labelFor: {
      type: String,
      default: null,
    },
    errors: {
      type: Array,
      default: () => [],
    },
  },
}
</script>
