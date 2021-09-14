<template>
  <div class="container mx-auto p-10 max-w-full md:max-w-10xl">
    <div class="flex flex-col md:flex-row space-y-5 md:space-y-0 md:space-x-5">
      <CalendarEventForm />
      <div />
    </div>
  </div>
</template>

<script>
import CalendarEventForm from './components/calendar-event/CalendarEventForm'

export default {
  components: { CalendarEventForm },
}
</script>
