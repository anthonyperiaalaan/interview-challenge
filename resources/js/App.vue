<template>
  <div class="container mx-auto p-10 max-w-full md:max-w-6xl">
    <div class="flex flex-col md:flex-row space-y-5 md:space-y-0 md:space-x-5">
      <CalendarEventForm class="w-full max-w-md" />
      <CalendarEventList class="w-full" />
    </div>
  </div>
</template>

<script>
import CalendarEventForm from './components/calendar-event/CalendarEventForm'
import CalendarEventList from '@/components/calendar-event/CalendarEventList'

export default {
  components: { CalendarEventList, CalendarEventForm },
}
</script>
