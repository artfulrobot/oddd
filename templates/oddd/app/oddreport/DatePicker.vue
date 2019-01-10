<template>
  <input format="yy-mm-dd" formattype="searchDate" @input="updateDate($event.target.value)"/>
</template>
<script>
export default {
  data() {
    return {
      date:''
    };
  },
  props: ['value'],
  created() {
    this.date = this.value;
  },
  methods: {
    updateDate(new_date) {
      this.date = new_date;
      this.$emit('input', new_date);
    }
  },
  mounted() {
    var vm=this;
    CRM.$(this.$el).datepicker({
      dateFormat:'yy-mm-dd',
      onSelect: vm.updateDate,
    });
  },
  beforeDestroy() {
    CRM.$(this.$el).datepicker('hide').datepicker('destroy');
  }
}
</script>
