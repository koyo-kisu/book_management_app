<template>
  <form method="POST" :action="endpoint">
    <input type="hidden" name="_token" :value="token" />
    <input type="hidden" name="book_id" :value="bookId" />
    <div class="modal-body mx-3">
      <div class="form-group">
        <label for="start_on_picker-input">貸出日</label>
        <VueCtkDateTimePicker
          id="start_on_picker"
          v-model="startOn"
          format="YYYY-MM-DD"
          formatted="YYYY-MM-DD(ddd)"
          label="日付を選択してください"
          color="#007bff"
          button-color="#28a745"
          :min-date="today"
          :disabled-dates="disabledDates"
          no-label
          no-shortcuts
          only-date
          auto-close
        ></VueCtkDateTimePicker>
        <input type="hidden" name="start_on" :value="startOn" />
      </div>
      <div class="form-group">
        <label for="end_on_picker-input">返却日</label>
        <VueCtkDateTimePicker
          id="end_on_picker"
          v-model="endOn"
          format="YYYY-MM-DD"
          formatted="YYYY-MM-DD(ddd)"
          label="日付を選択してください"
          color="#007bff"
          button-color="#28a745"
          :min-date="startOn || today"
          :max-date="endOnMaxDate"
          :disabled-dates="disabledDates"
          no-label
          no-shortcuts
          only-date
          auto-close
        ></VueCtkDateTimePicker>
        <input type="hidden" name="end_on" :value="endOn" />
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
      <button type="submit" class="btn btn-primary">予約する</button>
    </div>
  </form>
</template>

<script>
import VueCtkDateTimePicker from "vue-ctk-date-time-picker"
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css"
import moment from "moment"

export default {
  components: { VueCtkDateTimePicker },
  props: {
    endpoint: {
      type: String,
      required: true
    },
    token: {
      type: String,
      required: true
    },
    bookId: {
      type: String,
      required: true
    },
    bookings: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      startOn: null,
      endOn: null,
      lastBookingEnd: null,
      disabledDates: [],
    }
  },
  computed: {
    today() {
      return moment(new Date()).format("YYYY-MM-DD")
    },
    // 既存の予約をまたいでの予約を制限する
    endOnMaxDate() {
      if(!this.bookings.length) return ''
      if(this.startOn)
        return this.mostRecentStart(this.startOn)
    },
  },
  methods: {
    // datepickerの初期設定
    setCalendarOptions() {
      for (let i = 0; i < this.bookings.length; i++) {
        const booking = this.bookings[i]
        this.setDisabledDates(booking)
        // 一番先の返却日を保存
        if(this.bookings.length - 1 === i)
          this.lastBookingEnd = booking.end_on
      }
    },
    // 貸出中の日付を選択不可にする
    setDisabledDates(booking) {
      const bookingDates = this.listBookingDates(booking.start_on, booking.end_on)
      this.disabledDates = this.disabledDates.concat(bookingDates)
    },
    // 2つの日付間の日付をリストアップする
    listBookingDates(startDate, endDate) {
      const start = moment(startDate), end = moment(endDate)
      let list = []
      while(start.diff(end) <= 0) {
          const date = start.clone().format('YYYY-MM-DD')
          list.push(date)
          start.add(1, 'days')
      }
      return list
    },
    // 選択日付から一番近い貸出日
    mostRecentStart(date) {
      let diff = 0, recent = ''
      this.bookings.map(booking => {
        const _diff = this.momentDiff(date, booking.start_on)
        if(_diff > diff) {
          diff = _diff
          recent = booking.start_on
        }
      })
      return recent
    },
    momentDiff(st, ed) {
      const start = moment(st), end = moment(ed)
      console.log(start, end)
      return end.diff(start, 'days')
    }
  },
  created() {
    this.setCalendarOptions()
  }
};
</script>
