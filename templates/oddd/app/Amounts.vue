<template>
  <div>
    <div class="odd__buttons">
      <div v-for="a in presets" class="odd__button-wrapper">
        <button @click.prevent="selectAmount(a)"
                class="odd__button"
                :class="{ selected: a==local_amount }"
                >{{currency_symbol}}{{a}}</button>
      </div>
    </div>
    <div class="odd__amount-other">
      <label :for="id + '_other'">Other {{currency_symbol}}</label>
      <div class="odd__amount-other-input">
        <input :id="id + '_other'" v-model="local_amount" />
      </div>
    </div>

    <select v-model="local_currency" v-if="geo !== 'GB'">
      <option value="GBP" >&pound;</option>
      <option value="USD" >$</option>
      <option value="EUR" >&euro;</option>
    </select>

  </div>
</template>
<script>
export default {
  data() {
    return {
      id: null,
      local_amount: '',
      local_currency: 'GBP',
    };
  },
  props: ['allPresets', 'currency', 'recur', 'geo'],
  computed: {
    presets() {
      return this.allPresets[this.recur][this.local_currency] || [];
    },
    currency_symbol() {
      return {'GBP': '£', 'USD': '$', 'EUR': '€'}[this.local_currency];
    }
  },
  methods: {
    selectAmount(a) {
      console.log("setting amount...", a);
      this.local_amount = a;
      console.log("...emitting 'finished'");
      this.$emit('finished', {amount: this.local_amount, currency: this.local_currency});
    }
  },
  mounted () {
    this.id = this._uid;
    this.local_amount = this.amount;
    this.local_currency = this.currency;
  },
  watch: {
    local_amount: function(new_val, old_val) {
      this.$emit('updated', {amount: new_val, currency: this.local_currency});
    },
    local_currency: function(new_val, old_val) {
      this.$emit('updated', {currency: new_val, amount: this.local_amount});
    },
    currency: function(new_val, old_val) {
      // When parent's currency changes, change ours.
      this.local_currency = new_val;
    }
  }
};
</script>
<style lang="scss">
  .buttons button.selected {
    font-weight:bold;
  }
</style>
