<template>
  <div>
    <h1 class="text-2xl font-bold">
      {{ startDate.format('MMM YYYY') }}
    </h1>
    <CalendarEventListItem
      v-for="date in dates"
      :key="date.date()"
      :date="date"
      />
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import moment from 'moment'
import { FETCH_EVENTS } from '@/store/actions'
import CalendarEventListItem from '@/components/calendar-event/CalendarEventListItem'

export default {
  components: { CalendarEventListItem },
  computed: {
    ...mapState(['events', 'fetchingEvents']),
    startDate() {
      return moment().startOf('month')
    },
    dates() {
      const dates = []
      const d = this.startDate.clone()
      const endDate = moment().endOf('month')
      do {
        dates.push(d.clone())
        d.add(1, 'day')
      } while (d.isSameOrBefore(endDate))
      return dates
    },
  },
  created() {
    this[FETCH_EVENTS]()
  },
  methods: {
    ...mapActions([FETCH_EVENTS]),
  },
}
</script>
