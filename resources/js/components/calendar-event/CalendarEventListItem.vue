<template>
  <div class="flex items-center space-x-10 p-3 border-b">
    {{ displayDate }}
  </div>
</template>

<script>
import { Moment } from 'moment'

export default {
  props: {
    date: {
      type: Moment,
      required: true,
    },
  },
  computed: {
    displayDate() {
      return this.date.format('D ddd')
    },
  },
}
</script>
