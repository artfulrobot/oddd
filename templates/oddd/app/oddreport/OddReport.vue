<template>
  <div>
    <form class="controls">
      <span>
        <label :for="'since' + id">From</label>
        <date-picker v-model="date_from" :id="'since' + id"/>
      </span>
      <span>
        <label :for="'until' + id">To</label>
        <date-picker v-model="date_to" :id="'until' + id"/>
      </span>
      <select v-model="granularity" >
        <option value="day">Day</option>
        <option value="week">Week</option>
        <option value="month">Month</option>
        <option value="quarter">Quarter</option>
        <option value="year">Year</option>
      </select>
      <button @click="reloadData">Update</button>
    </form>
    <div class="alert alert-danger" style="margin:0.5rem 0;" v-if="error" >Error: {{error}}</div>
    <div v-show="!loading && stats.length>0">
      <div ref="periodBarchart">
        <h2>By Date</h2>
      </div>
      <div ref="projectPieChart">
        <h2>By Project</h2>
      </div>
      <div ref="campaignRowChart">
        <h2>By Campaign</h2>
      </div>
      <div ref="sourceRowChart">
        <h2>By Source</h2>
      </div>
    </div>
    <table v-if="!loading && stats.length>0">
      <thead>
        <tr>
          <th>Period</th>
          <th>Campaign</th>
          <th>Project</th>
          <th>Source</th>
          <th>&pound;</th>
          <th>Count</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="row in stats">
          <td>{{row[0]}}</td>
          <td>{{campaignTitle(row[1])}}</td>
          <td>{{row[2]}}</td>
          <td>{{row[3]}}</td>
          <td>{{row[4]}}</td>
          <td>{{row[5]}}</td>
        </tr>
      </tbody>
    </table>
    <div class="alert alert-warning" v-if="stats.length == 0 && !loading">No results</div>
    <div class="alert alert-info" v-if="loading">Loading stats...</div>
  </div>
</template>
<script>
console.log('app/oddreport/OddReport.vue');
import DatePicker from './DatePicker.vue'; // module not found at runtime.
//import DatePicker from '../DatePicker.vue'; // module not found at runtime.
export default {
  components: { DatePicker },
  data() {
    return {
      error: null,
      date_from  : null,
      date_to    : null,
      granularity : 'year',
      stats      : [],
      campaigns  : null,
      id         : null,
      loading    : false,

      charts     : [],
      ndx        : null,
    };
  },
  props: ['CRM', 'crossfilter', 'dc', 'd3'],
  methods: {
    campaignTitle(campaign_id) {
      return campaign_id ? this.campaigns[campaign_id] || '' : '';
    },
    reloadData() {
      this.error = null;
      this.loading = true;

      this.CRM.api3('Contribution', 'getoddstats', {
        date_from   : this.date_from,
        date_to     : this.date_to,
        granularity : this.granularity,
      })
      .then(r => {
        this.loading = false;
        if (r.is_error) {
          this.error = r.error_message || 'Unknown error';
          this.stats = null;
          return;
        }
        // Success.
        this.stats = r.values.contributions;
        this.campaigns = r.values.campaigns;
        this.drawCharts();
      }, e => {
        this.error = 'Network error';
        this.loading = false;
        console.log("ERROR", e);
      });
    },
    drawCharts() {
      console.log("drawCharts starts",this.stats);
      this.ndx = this.crossfilter(this.stats);
      console.log("ndx", this.ndx);
      // define group all for counting
      var all = this.ndx.groupAll();
      // define a dimension
      // Nb. in our data: period, campaign(1), project(2), source(3), £(4), #(5)
      var projectDimension = this.ndx.dimension(d => d[2] ? d[2] : 'N/A');
      var projectAmounts = projectDimension.group().reduceSum(d => d[4]);
      var campaignDimension = this.ndx.dimension(d => d[1] || 'none');
      var campaignAmounts = campaignDimension.group().reduceSum(d => d[4]);
      var sourceDimension = this.ndx.dimension(d => d[3]);
      var sourceAmounts = sourceDimension.group().reduceSum(d => d[4]);
      var periodDimension = this.ndx.dimension(d => d[0]);
      console.log("periodDimension", periodDimension);
      var periodAmounts = periodDimension.group().reduceSum(d => d[4]);

      const labelsAdjust = function(c) {
        c.selectAll('g.row text').style('fill', 'black');
      }
      console.log("d3", this.d3);

      this.charts.periodBarchart = this.dc.barChart(this.$refs.periodBarchart)
        .dimension(periodDimension)
        .group(periodAmounts)
        .width(990)
        .height(200)
        .x(this.d3.scale.ordinal())
        .xUnits(this.dc.units.ordinal)
        .margins({top: 10, right: 50, bottom: 30, left: 40})
      ;

      this.charts.projectPie = this.dc.pieChart(this.$refs.projectPieChart)
        .width(200) // (optional) define chart width, :default = 200
        .height(200) // (optional) define chart height, :default = 200
        .transitionDuration(500) // (optional) define chart transition duration, :default = 350
        .radius(90) // define pie radius
        .innerRadius(40) // optional
        .legend(this.dc.legend())
        .dimension(projectDimension) // set dimension
        .group(projectAmounts) // set group
        // (optional) by default pie chart will use group.key as it's label
        // but you can overwrite it with a closure
        //.label(function(d) { return d.; })
        // (optional) whether chart should render labels, :default = true
        .renderLabel(true)
        // (optional) by default pie chart will use group.key and group.value as its title
        // you can overwrite it with a closure
        //.title(function(d) { return JSON.stringify(d); })
        // (optional) whether chart should render titles, :default = false
        .renderTitle(true);

      this.charts.campaignRowChart = this.dc.rowChart(this.$refs.campaignRowChart)
        .width(990) // (optional) define chart width, :default = 200
        .height(24 * campaignAmounts.size())
        .margins({top: 10, right: 50, bottom: 30, left: 40})// (optional) define margins
        .dimension(campaignDimension) // set dimension
        .group(campaignAmounts) // set group
        .label(d => { return (d.key === 'none') ? d.key : this.campaigns[d.key] })
        .renderLabel(true)
        .title(function(d) { return JSON.stringify(d); })
        .renderlet(labelsAdjust)
        // (optional) whether chart should render titles, :default = false
        .renderTitle(true);

      this.charts.sourceRowChart = this.dc.rowChart(this.$refs.sourceRowChart)
        .width(990) // (optional) define chart width, :default = 200
        .height(24 * sourceAmounts.size())
        .margins({top: 10, right: 50, bottom: 30, left: 40})// (optional) define margins
        .dimension(sourceDimension) // set dimension
        .group(sourceAmounts) // set group
        .renderlet(labelsAdjust)
        // (optional) whether chart should rescale y axis to fit data, :default = false
        //.elasticY(true)
        // (optional) when elasticY is on whether padding should be applied to y axis domain, :default=0
        //.yAxisPadding(100)
        // define x scale
        //.x(d3.time.scale().domain([new Date(1985, 0, 1), new Date(2012, 11, 31)]))
        // (optional) set filter brush rounding
        //.round(d3.time.month.round)
        // define x axis units
        //.xUnits(d3.time.months)
        // (optional) whether bar should be center to its x value, :default=false
       //.centerBar(true)
       //// (optional) set gap between bars manually in px, :default=2
       //.barGap(1)
       //// (optional) render horizontal grid lines, :default=false
       //.renderHorizontalGridLines(true)
       //// (optional) render vertical grid lines, :default=false
       //.renderVerticalGridLines(true)
        // (optional) add stacked group and custom value retriever
        //.stack(monthlyMoveGroup, function(d){return d.value;})
        // (optional) whether this chart should generate user interactive brush to allow range
        // selection, :default=true.
        // .brushOn(true)
        // (optional) whether svg title element(tooltip) should be generated for each bar using
        // the given function, :default=no
        .title(function(d) { return "Value: " + d.key; })
        // (optional) whether chart should render titles, :default = false
        .renderTitle(true);
      this.dc.renderAll();
      console.log("drawCharts ends", this.charts.projectPie);
    }
  },
  directives: {
    charts(el, binding) {
      const vm = binding.vm;
      console.log("el", el.innerHTML);
    }
  },
  created() {
    console.log("app created");
    this.id = this._uid;
    this.reloadData();
  },
}
</script>
