<template>
<div>
  <div class="odd__container">
    <div class="odd__page">
      <div class="odd__body-text" v-html="body" />
    </div>
    <div class="odd__forms">
      <div v-if="regular_or_one[0] === 'o' && recur !== 'regular'"
        class="odd__form">
        <h2>One Off</h2>
        <div v-show='step === "step1"'>
          <amounts :allPresets="presets" currency="GBP" recur="oneoff"
                    @updated="amount=$event.amount"
                    @finished="recur='oneoff'; step='step2';"
          ></amounts>
          <button :disabled="!amount" class="odd__next-button" @click.prevent="recur='oneoff'; step='step2'">Next</button>
        </div>
        <div v-show="step==='step2' && recur==='oneoff'">
          <button @click.prevent="step='step1';recur=null;"  class="odd__back-button">Back</button>
          <name-address
            @updated="updateNameAddress"
            v-bind="{first_name, last_name, address, city, postal_code, country}"
            />
          <div class="odd__donate-button">
            <button @click.prevent="startPayment" >Donate</button>
          </div>
        </div>
      </div>
      <div v-if="regular_or_one[1] === 'r' && recur !== 'oneoff'"
        class="odd__form">
        <h2>Monthly</h2>
        <div v-show='step === "step1"'>
          <amounts :allPresets="presets" currency="GBP" recur="regular"
            v-bind="{currency, amount}"
                    @updated="amount=$event.amount"
                    @finished="recur='regular'; step='step2';"
          ></amounts>
          <button :disabled="!amount" class="odd__next-button" @click.prevent="recur='regular'; step='step2'">Next</button>
        </div>
        <div v-show="step==='step2' && recur==='regular'">
          <button @click.prevent="step='step1';recur=null;" class="odd__back-button">Back</button>
          <name-address v-show="amount>0 && recur==='regular'"
            @cancel="step='step1';recur=null;"
            v-bind="{first_name, last_name, address, city, postal_code, country}"
            @updated="updateNameAddress"
            />
          <div class="odd__donate-button">
            <button @click.prevent="startPayment" >Donate</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import Axios from 'axios';
import Amounts from './Amounts.vue';
import NameAddress from './NameAddress.vue';
export default {
  components: {Amounts, NameAddress},
  data() {
    return {
      amount: '',
      currency: '',
      recur: null,
      step: 'step1',

      first_name: 'Pebbles',
      last_name: 'Flintstone',
      address: '',
      city: '',
      postal_code: '',
      country: 'United Kingdome',

    };
  },
  methods: {
    up(e, o) {
      console.log("event", e, o);
    },
    updateNameAddress(e) {
      this.first_name = e.first_name;
      this.last_name = e.last_name;
      this.address = e.address;
      this.city = e.city;
      this.postal_code = e.postal_code;
      this.country = e.country;
    },
    startPayment() {
      // OK.
      const data={};
      data.method = 'paypal'; // ??? xxx
      data.nid = this.nid;
      data.geo = this.geo;
      data.first_name = this.first_name;
      data.last_name = this.last_name;
      data.address = this.address;
      data.city = this.city;
      data.postal_code = this.postal_code;
      data.country = this.country;
      data.email = this.email;
      data.amount = this.amount;
      data.currency = this.currency;
      data.is_recur = (this.recur === 'regular') ? 1 : 0;
      Axios.post('/oddd/api', data)
      .then(response => {
        console.log("got response", response);
        //window.location = response.url;
      }, error => {
        console.error(error);
        if (error.response) {
          console.log("got error", error.response.data);
        }
        else {
          console.log("got error", error);
        }
      });
    }
  },
  props: [
      'title' ,
      'nid' ,
      'geo' ,
      'body' ,
      'regular_or_one' ,
      'presets' ,
      'account' ,
      'geoip'
    ]
}
</script>
