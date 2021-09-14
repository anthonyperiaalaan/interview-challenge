<template>
  <el-date-picker
    class="!w-full"
    :value="value"
    :placeholder="placeholder"
    value-format="yyyy-MM-dd"
    type="daterange"
    range-separator="To"
    start-placeholder="Start date"
    end-placeholder="End date"
    @input="onInput"
    />
</template>

<script>
export default {
  props: {
    value: {
      type: Array,
      default: null,
    },
    placeholder: {
      type: String,
      default: null,
    },
  },
  methods: {
    onInput(e) {
      if (!e || e.length < 2) {
        this.$emit('input', [null, null])
        return
      }
      this.$emit('input', e)
    },
  },
}
</script>
