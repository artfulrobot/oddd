<template>
<div>
  <div class="odd__container">
    <mark v-if="config.mode == 'test'" class="odd__test-mode">Test mode active!</mark>
    <div class="odd__standfirst" v-html="standfirst" />
    <div class="odd__mobile-top-forms">
      <forms
        v-if="isMobile && config.regular_or_one[1] === 'r'"
        :config='config'
        :isMobile="isMobile"
        :show_regular='true'
        :show_oneoff='false'
        />
    </div>
    <div class="odd__body-text" v-html="body" />
    <div class="odd__main-forms">
      <forms :config='config'
        :isMobile="isMobile"
        :show_regular='config.regular_or_one[1] === "r"'
        :show_oneoff='config.regular_or_one[0] === "o"'
        />
    </div>
  </div>
  <div class="odd__extra-wrapper">
    <button class="show-more" href v-if="extra && !showExtra" @click.prevent="showExtra = true">Other ways to give</button>
    <div class="odd__extra-text" v-html="extra" v-show="showExtra"/>
  </div>
</div>
</template>
<script>
var foreach = require('lodash/forEach');
var debounce = require('lodash/debounce');
import Forms from './Forms.vue';
import Axios from 'axios';
import Amounts from './Amounts.vue';
import NameAddress from './NameAddress.vue';
export default {
  components: {Forms},
  data() {
    return {
      showExtra: false,
      standfirst: null,
      body: null,
      extra : null,
      showExtra: false,
      isMobile: false,
    };
  },
  props: [ 'config' ],
  created() {
    const vm = this;
    foreach([
      'body', 'standfirst', 'extra'
    ], field => vm[field] = vm.config[field] );

    // We need to detect mobile.
    window.addEventListener('resize', debounce(e => { vm.detectMobile(); }, 100));
    this.detectMobile();
  },
  computed: {
  },
  methods: {
    detectMobile() {
      this.isMobile = window.matchMedia('screen and (max-width: 767px)').matches;
    }
  },
}
</script>
