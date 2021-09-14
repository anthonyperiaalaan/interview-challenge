<template>
  <div>
    <ValidationObserver
      ref="form"
      v-slot="{ handleSubmit }"
      >
      <form @submit.prevent="handleSubmit(submit)">
        <ValidationProvider
          v-slot="{ errors, classes }"
          name="title"
          rules="required"
          >
          <FormGroup
            label="Event"
            :errors="errors"
            >
            <FormInput
              name="title"
              :class="classes"
              :value="eventForm.title"
              @input="onInput('title', $event)"
              />
          </FormGroup>
        </ValidationProvider>
        <ValidationProvider
          v-slot="{ errors, classes }"
          name="start_date"
          rules="required"
          >
          <FormGroup
            label="Date Range"
            :errors="errors"
            >
            <FormDateRangeInput
              v-model="dateRange"
              name="start_date"
              :class="classes"
              />
          </FormGroup>
        </ValidationProvider>
        <ValidationProvider
          v-slot="{ errors, classes }"
          name="days"
          rules="required"
          >
          <FormGroup
            label="Days"
            :errors="errors"
            >
            <DayOfWeekCheckboxGroup
              name="days"
              :class="classes"
              :value="eventForm.days"
              @input="onInput('days', $event)"
              />
          </FormGroup>
        </ValidationProvider>

        <el-button
          type="primary"
          native-type="submit"
          :loading="savingEvent"
          >
          Save
        </el-button>
      </form>
    </ValidationObserver>
  </div>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex'
import { get } from 'lodash'
import FormInput from '../form/FormInput'
import FormGroup from '../form/FormGroup'
import FormDateRangeInput from '../form/FormDateRangeInput'
import { SET_EVENT_FORM_FIELD } from '@/store/mutations'
import DayOfWeekCheckboxGroup from '@/components/calendar-event/DayOfWeekCheckboxGroup'
import { SAVE_EVENT } from '@/store/actions'
import { UNPROCESSABLE_ENTITY } from '@/constants/http-status-codes'

export default {
  components: {
    DayOfWeekCheckboxGroup, FormDateRangeInput, FormGroup, FormInput,
  },
  computed: {
    ...mapState(['eventForm', 'savingEvent']),
    dateRange: {
      get() {
        if (!this.eventForm.start_date) {
          return null
        }

        return [
          this.eventForm.start_date,
          this.eventForm.end_date,
        ]
      },
      set([startDate = null, endDate = null]) {
        this[SET_EVENT_FORM_FIELD]({ key: 'start_date', value: startDate })
        this[SET_EVENT_FORM_FIELD]({ key: 'end_date', value: endDate })
      },
    },
  },
  methods: {
    ...mapMutations([SET_EVENT_FORM_FIELD]),
    ...mapActions([SAVE_EVENT]),
    onInput(key, value) {
      this[SET_EVENT_FORM_FIELD]({ key, value })
    },
    async submit() {
      try {
        await this[SAVE_EVENT]()
        this.$notify.success({
          title: 'Success',
          message: 'Calendar event has been saved.',
        })
      } catch (e) {
        const status = get(e, 'response.status')
        if (status === UNPROCESSABLE_ENTITY) {
          this.$refs.form.setErrors(e.response.data.errors)
        } else {
          this.$notify.error({
            title: 'Oops!',
            message: 'Something happened unexpectedly.',
          })
        }
      }
    },
  },
}
</script>
