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
          no-label
          no-shortcuts
          only-date
          auto-close
        ></VueCtkDateTimePicker>
        <input type="hidden" name="start_on" :value="startOn">
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
          no-label
          no-shortcuts
          only-date
          auto-close
        ></VueCtkDateTimePicker>
        <input type="hidden" name="end_on" :value="endOn">
      </div>
    </div>
    <div class="modal-footer justify-content-between">
      <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
      <button type="submit" class="btn btn-primary">予約する</button>
    </div>
  </form>
</template>

<script>
import moment from 'moment';
import VueCtkDateTimePicker from "vue-ctk-date-time-picker";
import "vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css";
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
    }
  },
  data() {
    return {
      startOn: null,
      endOn: null,
    };
  },
  computed: {
    today() {
      return moment(new Date).format('YYYY-MM-DD');
    },
  },
};
</script>
