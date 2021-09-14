<template>
  <div
    class="flex items-center space-x-10 p-3 border-b"
    :class="{'bg-green-100': !!shownEvent}"
    >
    <span class="w-20">
      {{ displayDate }}
    </span>
    <span>
      {{ shownEvent ? shownEvent.title : '' }}
    </span>
  </div>
</template>

<script>
import { Moment } from 'moment'
import { mapState } from 'vuex'

export default {
  props: {
    date: {
      type: Moment,
      required: true,
    },
  },
  computed: {
    ...mapState(['events']),
    displayDate() {
      return this.date.format('D ddd')
    },
    shownEvent() {
      const date = this.date.format('YYYY-MM-DD')

      return this.events.find((e) => e.days.includes(this.date.day()) && date >= e.start_date && date <= e.end_date)
    },
  },
}
</script>
