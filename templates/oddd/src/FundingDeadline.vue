<!-- v0.1 This component needs to be shared between petition and oddd projects -->
<template>
  <div v-if="showDeadline" class="od_fund_deadline">
  <div class="period">{{period}}</div>
  <div class="text">{{displayText}}</div>
  </div>
</template>
<style lang="scss" scoped>
$light_blue: #F1F6FB;
$light_blue_darkened: darken(#F1F6FB, 10%);
$dark_blue: #0061bf;
$dark_blue_lightened: #408BC5; // From new site.
$grey_4: #444;
$grey_6: #888;
$accent: #b75601;
.od_fund_deadline {
  display: flex;
  align-items: center;
  .period {
    padding: 0 0.5rem;
    color: $dark_blue;;
    flex: 0 0 auto;
    font-size: 2rem;
    font-weight: bold;
  }
  .text {
    padding-left: 1rem;
    flex: 1 0 8rem;
  }
}
</style>
<script>
export default {
  data() {
    return {
      displayText: '',
      period: '',
    };
  },
  props: {
    dlDate: {type: String, default: ''},
    dlText: {type: String, default: ''},
  },
  computed: {
    showDeadline() {
      if (!this.dlDate) {
        // No deadline, don't show it.
        return false;
      }
      return true;
    },
  },
  methods: {
    updateDeadline() {
      var d = new Date(this.dlDate);
      var diffTime = d - (new Date());
      var diffDays = (diffTime / (1000 * 60 * 60 * 24));

      if (diffTime < 0) {
        this.period = '';
        this.displayText = 'Deadline has passed.';
        return;
      }
      this.displayText = this.dlText;

      if (diffDays > 1) {
        // It's over 24 hours away. Report days.
        d.setHours(0); d.setMinutes(0); d.setSeconds(0);
        var n = new Date();
        n.setHours(0); n.setMinutes(0); n.setSeconds(0);
        diffDays = Math.round((d - n) / 1000 / 60 / 60 / 24);

        this.period = diffDays + ' day' + (diffDays > 1 ? 's' : '');
        return;
      }

      // It's less than 24 hours away
      const hours = Math.floor(diffTime / 1000 / 60 / 60);
      const mins = Math.floor((diffTime / 1000 / 60) - hours*60);
      if (hours > 11) {
        this.period = hours + ' hours';
        return;
      }

      this.period =
        (hours > 0 ? ( hours + ' hour' + (hours>1 ? 's, ': ', ')) : '')
        + mins + (mins>1 ? 'mins' : '');
    },

  },
  created() {
    // Funding deadline?
    if (this.dlDate) {
      this.updateDeadline();
      if (this.period.match(/minutes/)) {
        // Update every minute.
        window.setInterval(this.updateDeadline.bind(this), 60000);
      }
    }
  }

};
</script>
