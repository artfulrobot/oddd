<template>
  <div>
    <div class="odd__buttons">
      <div v-for="a in presets" class="odd__button-wrapper">
        <button @click.prevent="selectAmount(a)"
                class="odd__button"
                :class="{ selected: a==amount }"
                >{{currency_symbol}}{{a}}</button>
      </div>
    </div>
    <div class="odd__amount-other">
      <label :for="id + '_other'">Other {{currency_symbol}}</label>
      <div class="odd__amount-other-input">
        <input :id="id + '_other'" v-model="amount" />
      </div>
    </div>
  </div>

</template>
<script>
export default {
  data() {
    return {
      id: null,
      amount: ''
    };
  },
  props: ['allPresets', 'currency', 'recur'],
  computed: {
    presets() {
      return this.allPresets[this.recur][this.currency] || [];
    },
    currency_symbol() {
      return {'GBP': '£', 'USD': '$', 'EUR': '€'}[this.currency];
    }
  },
  methods: {
    selectAmount(a) {
      this.amount = a;
      this.$emit('finished');
    }
  },
  mounted () {
    this.id = this._uid;
  },
  watch: {
    amount: function(new_val, old_val) {
      console.log("amount updated to ", new_val);
      this.$emit('updated', {amount: new_val});
    }
  }
};
</script>
<style lang="scss">
  .buttons button.selected {
    font-weight:bold;
  }
</style>
