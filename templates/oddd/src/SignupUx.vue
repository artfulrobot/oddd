<template>
<div>
  <div class="odd__container">
    <mark v-if="config.mode == 'test'" class="odd__test-mode">Test mode active!</mark>
    <div class="odd__standfirst" v-html="processedStandfirst" />
    <div class="odd__mobile-top-forms"></div><!-- @todo -->
    <div class="odd__body-text" v-html="body" />
    <div class="odd__main-forms">
      <signup
        :config="config"
        @completed=""
      ></signup>
    </div>
  </div>
  <div class="odd__extra-wrapper">
    <button class="show-more" href v-if="extra && !showExtra" @click.prevent="showExtra = true">Other ways to give</button>
    <div class="odd__extra-text" v-html="extra" v-show="showExtra"/>
  </div>

  <div ref="shareQuestion" v-show="page > 1">
    Share
  </div>
</div>
</template>
<script>
import Forms from './Forms.vue';
import Signup from './Signup.vue';
var debounce = require('lodash/debounce');
export default {
  components: {Forms, Signup},
  props: [ 'config' ],
  data() {
    return {
      showExtra: false,
      standfirst: null,
      body: null,
      extra : null,
      isMobile: false,
      page: 1,
    };
  },
  created() {
    const vm = this;
    ['body', 'standfirst', 'extra']
      .forEach(field => { vm[field] = vm.config[field]; });

    // We need to detect mobile.
    window.addEventListener('resize', debounce(e => { vm.detectMobile(); }, 100));
    this.detectMobile();
  },
  computed: {
    processedStandfirst() {
      // This takes the current giving statement string, converts it to HTML,
      // and swaps out '{contact.currentRegularGiving}' in the standfirst for this HTML.
      var dummy = document.createElement('div');
      dummy.textContent = this.config.giving;
      return this.standfirst.replace('{contact.currentRegularGiving}', dummy.innerHTML );
    }
  },
  methods: {
    detectMobile() {
      this.isMobile = window.matchMedia('screen and (max-width: 767px)').matches;
    }
  },
};
</script>
