<template>
  <form method="POST" :action="endpoint">
    <input type="hidden" name="_token" :value="token" />
    <input type="hidden" name="book_id" :value="bookId" />
    <div class="modal-body mx-3">
      <div class="form-group">
        <label for="booking_date_from_picker-input">貸出日</label>
        <VueCtkDateTimePicker
          id="booking_date_from_picker"
          v-model="dateFrom"
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
        <input type="hidden" name="booking_date_from" :value="dateFrom" />
      </div>
      <div class="form-group">
        <label for="booking_date_to_picker-input">返却日</label>
        <VueCtkDateTimePicker
          id="booking_date_to_picker"
          v-model="dateTo"
          format="YYYY-MM-DD"
          formatted="YYYY-MM-DD(ddd)"
          label="日付を選択してください"
          color="#007bff"
          button-color="#28a745"
          :min-date="dateFrom || today"
          :max-date="dateToMaxDate"
          :disabled-dates="disabledDates"
          no-label
          no-shortcuts
          only-date
          auto-close
        ></VueCtkDateTimePicker>
        <input type="hidden" name="booking_date_to" :value="dateTo" />
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
      dateFrom_: null,
      dateTo: null,
      lastBookingEnd: null,
      disabledDates: [],
    }
  },
  computed: {
    dateFrom: {
      get() { return this.dateFrom_ },
      set(value) {
        this.dateFrom_ = value
        this.dateTo = value // 返却日も自動で更新しデータ不整合予防
      },
    },
    today() {
      return moment(new Date()).format("YYYY-MM-DD")
    },
    // 既存の予約をまたいでの予約を制限する
    dateToMaxDate() {
      if(!this.bookings.length) return ''
      if(this.dateFrom)
        return this.mostRecentStart(this.dateFrom)
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
          this.lastBookingEnd = booking.booking_date_to
      }
    },
    // 貸出中の日付を選択不可にする
    setDisabledDates(booking) {
      const bookingDates = this.listBookingDates(booking.booking_date_from, booking.booking_date_to)
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
        const _diff = this.momentDiff(date, booking.booking_date_from)
        if(_diff > diff) {
          diff = _diff
          recent = booking.booking_date_from
        }
      })
      return recent
    },
    momentDiff(st, ed) {
      const start = moment(st), end = moment(ed)
      return end.diff(start, 'days')
    }
  },
  created() {
    this.setCalendarOptions()
  }
};
</script>
