<template>
  <input
    type="text"
    :value="value"
    class="form-input block rounded border-gray-200 w-full"
    @input="$emit('input', $event.target.value)"
    >
</template>

<script>
export default {
  props: {
    value: {
      type: [String],
      default: null,
    },
  },
}
</script>
