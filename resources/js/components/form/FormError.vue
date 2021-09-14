<template>
  <div class="text-red-600 text-sm">
    {{ error }}
  </div>
</template>

<script>
export default {
  props: {
    error: {
      type: String,
      required: true,
    },
  },
}
</script>
