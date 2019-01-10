//var foreach = require('lodash/forEach');
import Vue from 'vue';
import OddReport from './OddReport.vue';
export default {
  main(CRM, crossfilter, dc) {
    const app = new Vue({
      el: '#odd-report-app',
      render: h => h(OddReport, {props: {CRM, crossfilter, dc, d3}})
    });
  }
}
