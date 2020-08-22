import './bootstrap'
import Vue from 'vue'
import ArticleLike from './components/ArticleLike'
import ArticleTagsInput from './components/ArticleTagsInput'
import BookingDateInput from './components/BookingDateInput'
import BookImageInput from './components/BookImageInput'

const app = new Vue({
  el: '#app',
  components: {
    ArticleLike,
    ArticleTagsInput,
    BookingDateInput,
    BookImageInput,
  }
})
