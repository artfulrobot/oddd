<template>
<div>
  <div class="odd-page">
    <div class="odd__container">
      <mark v-if="config.mode == 'test'" class="odd__test-mode">Test mode active!</mark>
      <div class="odd__standfirst" v-html="processedStandfirst" />
      <div class="odd__mobile-top-forms"></div><!-- @todo -->
      <div class="odd__body-text" v-html="body" />
      <div class="odd__main-forms">
        <signup v-show="page === 1"
          :config="config"
          @completed="signupCompleted($event)"
        ></signup>
        <a @click.prevent="signupCompleted({first_name: 'Rich', last_name: 'Lott', email: 'forums@artfulrobot.uk', consent:1})">test</a>
        <p v-show="page > 1">Thanks!</p>
      </div>
    </div>
    <div class="odd__extra-wrapper">
      <button class="show-more" href v-if="extra && !showExtra" @click.prevent="showExtra = true">Other ways to give</button>
      <div class="odd__extra-text" v-html="extra" v-show="showExtra"/>
    </div>
  </div>

  <div class="odd-page" ref="shareQuestion" v-show="page > 1">
    <h2>Thanks, you're all signed up.</h2>
    <p>Can you share this with your friends?</p>
    <div class="question-container">
      <button @click.prevent="showShare()">Yes</button>
      <button @click.prevent="skipShare()">No</button>
    </div>
  </div>

  <div class="odd-page" ref="shareLinks" v-show="willShare">
    <h2>Please share with your friends</h2>

    <div class="odd-social-wrapper">

      <div class="odd-social-company" v-if="config.facebook" >
        <a href @click.prevent="shareOnFacebook()">
          <svg role="img" class="icon icon-facebook" viewBox="16 15 19 19" width="20px" height="20px">
            <title>Share on Facebook</title>
            <use xlink:href="#icon-facebook" class="icon-style"></use>
          </svg>
        </a>
      </div>

      <div class="odd-social-company" v-if="config.tweet">
        <a href @click.prevent="shareOnTwitter()" >
           <svg role="img" class="icon icon-twitter" viewBox="16 15 19 19" width="20px" height="20px">
             <title>Share on Twitter</title>
             <use xlink:href="#icon-twitter" class="icon-style"></use>
           </svg>
        </a>
      </div>
    </div>
  </div>

  <div class="odd-page" ref="donateQuestion" v-show="page >= 3">
    <h2>Can you donate?</h2>
    <div class="question-container">
      <button @click.prevent="showDonate()">Yes</button>
      <button @click.prevent="skipDonate()">No</button>
    </div>
  </div>

  <div class="odd-page" ref="donateForms" v-show="willDonate">
    <h2>donate now</h2>
    <forms
      :config='config'
      :isMobile="isMobile"
      :show_regular='config.regular_or_one[1] === "r"'
      :show_oneoff='config.regular_or_one[0] === "o"'
      :fixed='page1data'
      />
  </div>

  <div class="odd-page" ref="end" v-show="page === 4">
    <h2>Thanks!</h2>
  </div>


</div>
</template>

<style lang="scss" scoped>
.odd-page {
  min-height: 90vh;
}
</style>

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
      page1data: null,
      willShare: null,
      willDonate: null,
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
    niceScrollTo(el) {
      const durationInMilliSeconds=300;
      const yStart = window.scrollY;
      this.$nextTick(() => {
        el.scrollIntoView();
        const yEnd = window.scrollY - 50; // Allow 50px
        window.scrollTo(0, yStart);
        var start;
        function step(timestamp) {
          if (!start) start = timestamp;
          var progress = Math.min((timestamp - start)/durationInMilliSeconds, 1); // allow 300ms
          window.scrollTo(0,  (0.5 - Math.cos(Math.PI*progress)/2) * (yEnd - yStart) + yStart);
          if (progress < 1) {
            window.requestAnimationFrame(step);
          }
        }
        window.requestAnimationFrame(step);
      });
    },
    detectMobile() {
      this.isMobile = this.$root.isMobile();
    },
    signupCompleted(e) {
      this.page1data = e;
      this.page = 2;
      console.log("fixed p1 data", this.page1data);

      // @todo nice slow scroll.
      this.niceScrollTo(this.$refs.shareQuestion);
    },
    showShare() {
      this.willShare = true;
      this.niceScrollTo(this.$refs.shareLinks);
    },
    skipShare() {
      this.willShare = false;
      this.page = 3;
      this.niceScrollTo(this.$refs.donateQuestion);
    },
    showDonate() {
      this.willDonate = true;
      this.niceScrollTo(this.$refs.donateForms);
    },
    skipDonate() {
      this.willDonate = false;
      this.page = 4;
      this.niceScrollTo(this.$refs.end);
    },
    shareOnFacebook() {
      window.open(
        'https://www.facebook.com/sharer.php?u=' + encodeURIComponent(window.location.href),
        'sharer',
        'toolbar=0,status=0,width=548,height=325');
      this.page = 3;
      this.niceScrollTo(this.$refs.donateQuestion);
    },
    shareOnTwitter() {
      window.open(
        'https://twitter.com/intent/tweet?text=' + encodeURIComponent(this.config.tweet)
          + '&url=' + encodeURIComponent(window.location.href));
      this.page = 3;
      this.niceScrollTo(this.$refs.donateQuestion);
    },
  },
};
</script>
