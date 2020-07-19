<template>
  <div>
    <VueCtkDateTimePicker
      id="date-range-picker"
      v-model="value"
      format="YYYY-MM-DD"
      formatted="YYYY-MM-DD(ddd)"
      label="期間を選択してください"
      color="#007bff"
      button-color="#28a745"
      no-label
      no-shortcuts
      range
    ></VueCtkDateTimePicker>
    <input type="hidden" name="start_on" :value="startOn">
    <input type="hidden" name="end_on" :value="endOn">
  </div>
</template>

<script>
  import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
  import 'vue-ctk-date-time-picker/dist/vue-ctk-date-time-picker.css';
  export default {
    components: {VueCtkDateTimePicker},
    data() {
      return {
        value: null
      }
    },
    computed: {
      startOn() {
        return this.value ? this.value.start : null;
      },
      endOn() {
        return this.value ? this.value.end : null;
      },
    }
  }
</script>

<style lang="scss" scoped>

</style>
