<template>
  <div>
    <div class="image-wrapper">
      <a :href="imgSrcHandler" class="image-responsive" target="_blank" rel="noopener noreferrer">
        <img :src="imgSrcHandler" alt="image" class="card-img-top image-fit">
      </a>
    </div>
    <input type="file" name="book_image" @change="fileChange">
  </div>
</template>

<script>
  export default {
    props: {
      imgSrc: {
        type: String,
      }
    },
    data() {
      return {
        fileURL: ""
      }
    },
    computed: {
      imgSrcHandler() {
        return this.fileURL
          ? this.fileURL
          : "http://placehold.it/200x270"
      }
    },
    methods: {
      fileChange(e) {
        const files = e.target.files
        if(!files.length) {
          this.fileURL = ""
          return
        }

        // fileのURLを作成
        const file = files[0]
        const url = URL.createObjectURL(file)
        this.fileURL = url
      }
    },
    created() {
      if(this.imgSrc) this.fileURL = this.imgSrc;
    }
  }
</script>

<style lang="scss" scoped>

</style>
