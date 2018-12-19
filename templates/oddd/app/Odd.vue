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
          <amounts :allPresets="presets" recur="oneoff"
                    v-bind="{currency, amount: amount_oneoff, geo}"
                    @updated="updateAmount($event, 'oneoff')"
                    @finished="amountPresetClicked($event, 'oneoff')"
          ></amounts>
          <button :disabled="!amount_oneoff" class="odd__next-button" @click.prevent="recur='oneoff'; step='step2';">Next</button>
        </div>
        <div v-show="step==='step2' && recur==='oneoff'">
          <button @click.prevent="step='step1';recur=null;"  class="odd__back-button"
            >Back</button>
          <name-address
            @updated="updateNameAddress"
            v-bind="{geo, first_name, last_name, email, address, city, postal_code, country}"
            />
          <div class="odd__donate-button">
            <button @click.prevent="startPayment" >Donate</button>
          </div>
        </div>
        <div v-show="step==='step3' && recur==='oneoff'">
          Just a mo, redirecting you to the secure payment page...
        </div>
      </div>
      <div v-if="regular_or_one[1] === 'r' && recur !== 'oneoff'"
        class="odd__form">
        <h2>Monthly</h2>
        <div v-show='step === "step1"'>
          <amounts :allPresets="presets" recur="regular"
            v-bind="{currency, amount: amount_regular, geo}"
            @updated="updateAmount($event, 'regular')"
            @finished="amountPresetClicked($event, 'regular')"
          ></amounts>
          <button :disabled="!amount_regular" class="odd__next-button" @click.prevent="recur='regular'; step='step2';">Next</button>
        </div>
        <div v-show="step==='step2' && recur==='regular'">
          <button @click.prevent="step='step1';recur=null;"
            class="odd__back-button"
            >Back</button>
          <name-address
            @cancel="step='step1';recur=null;"
            v-bind="{geo, first_name, last_name, email, address, city, postal_code, country}"
            @updated="updateNameAddress"
            />
          <div class="odd__donate-button">
            <button @click.prevent="startPayment"
              >Donate</button>
          </div>
        </div>
        <div v-show="step==='step3' && recur==='regular'">
          Just a mo, redirecting you to the secure payment page...
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
      amount_regular: '',
      amount_oneoff: '',
      currency: 'GBP',
      recur: null,
      step: 'step1',
      source: '',

      first_name: 'Pebbles',
      last_name: 'Flintstone',
      email: 'forums@artfulrobot.uk',
      address: '',
      city: '',
      postal_code: '',
      country: 'United Kingdom',
      test_mode: false,

    };
  },
  methods: {
    updateAmount(e, recur) {
      console.log("updateAmount", e);
      this['amount_' + recur] = e.amount;
      this.currency=e.currency;
    },
    amountPresetClicked(e, recur) {
      this.updateAmount(e, recur);
      this.recur = recur;
      this.step ='step2';
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
      this.step = 'step3';
      // OK.
      const data={};
      data.method = 'paypal'; // ??? xxx
      data.email = this.email;
      data.amount = this['amount_' + this.recur];
      data.nid = this.nid;
      data.geo = this.geo;
      data.source = this.source;
      data.first_name = this.first_name;
      data.last_name = this.last_name;
      data.address = this.address;
      data.city = this.city;
      data.postal_code = this.postal_code;
      data.country = this.country;
      data.currency = this.currency;
      data.is_recur = (this.recur === 'regular') ? 1 : 0;
      data.test_mode = this.test_mode;
      Axios.post('/oddd/api', data)
      .then(response => {
        console.log("got response", response);
        if (response.data.url) {
          window.location = response.data.url;
        }
      })
      .catch( error => {
        if (error.response) {
          // Got reply.
          console.log(error.response.data);
        }
        else if (error.request) {
          console.log('Request made but no response', error);
        }
        else {
          console.log('Network error');
        }
        this.step = 'step2';
        alert("Sorry there was a problem.");
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
