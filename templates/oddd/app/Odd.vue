<template>
<div>
  <div class="odd__container">
    <div class="odd__page">
      <div class="odd__body-text" v-html="body" />
    </div>
    <div class="odd__forms">
      <div v-if="regular_or_one[0] === 'o' && step==='step1'" class="odd__form">
        <h2>One Off</h2>
        <amounts :allPresets="presets" recur="oneoff"
                  v-bind="{currency, amount: amount_oneoff, geo}"
                  @updated="updateAmount($event, 'oneoff')"
                  @finished="amountPresetClicked($event, 'oneoff')"
                  ></amounts>
        <button :disabled="!amount_oneoff" class="odd__next-button" @click.prevent="moveToStep2('oneoff', amount_oneoff)">Next</button>
      </div>

      <div v-if="regular_or_one[1] === 'r' && step==='step1'" class="odd__form">
        <h2>Monthly</h2>
        <amounts :allPresets="presets" recur="regular"
                 v-bind="{currency, amount: amount_regular, geo}"
                 @updated="updateAmount($event, 'regular')"
                 @finished="amountPresetClicked($event, 'regular')"
                 ></amounts>
        <button :disabled="!amount_regular" class="odd__next-button" @click.prevent="moveToStep2('regular', amount_regular)">Next</button>
      </div>

      <div v-show="step==='step2'" class="odd__form">
        <h2>{{box_title}}</h2>
        <button @click.prevent="step='step1';recur=null;"  class="odd__back-button" >Back</button>
        <name-address
          @updated="updateNameAddress"
          v-bind="{geo, first_name, last_name, email, street_address, city, postal_code, country, countries}"
          />
        <div v-if="geo === 'GB' && legal_entity === 'charity'" class="odd__giftaid">
          <h3>Gift Aid</h3>
          <div class="odd__checkbox">
            <input type="checkbox" v-model="giftaid" :id="'giftaid' + id" />
            <label :for="'giftaid' + id" >Yes I'm eligible</label>
          </div>
          <p>I confirm that I am UK taxpayer and I understand that if I pay
            less income tax and/or capital gains tax in the current tax year than
            the amount of Gift Aid claimed on all my pledges it is my
            responsibility to pay the difference. </p>
        </div>
        <div >
          <p>Shall we add you to our email newsletter list? You can unsubscribe at any time.</p>
          <div class="odd__checkbox">
            <input value="1" type="radio" :name="'consent' + id" v-model="consent" :id="'consent-y' + id" />
            <label :for="'consent-y' + id" >Yes please</label>
          </div>
          <div class="odd__checkbox">
            <input value="0" type="radio" :name="'consent' + id" v-model="consent" :id="'consent-n' + id" />
            <label :for="'consent-n' + id" >I'm already on it, or I don't want to be signed up.</label>
          </div>
        </div>
        <div class="odd__donate-button">
          <button @click.prevent="startPayment" >Donate</button>
        </div>
      </div>

      <div v-show="step==='step3'" class="odd__form">
        <h2>{{box_title}}</h2>
        <p>Just a mo, redirecting you to the secure payment page...</p>
      </div>
    </div>
  </div>
</div>
</template>
<script>
var foreach = require('lodash/forEach');
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
      giftaid: false,
      consent: null,

      test_mode: false,

      'title' : null,
      'nid' : null,
      'geo' : null,
      'body' : null,
      'source': null,
      'regular_or_one' : null,
      'presets' : null,
      'legal_entity': null,
      'geoip': null,
      'first_name': null,
      'last_name': null,
      'email': null,
      'street_address': null,
      'city': null,
      'postal_code': null,
      'country': null,
      'countries': null,
    };
  },
  props: [ 'config' ],
  created() {
    const vm = this;
    foreach([
      'title', 'nid', 'geo', 'body', 'source', 'regular_or_one', 'presets', 'legal_entity',
      'geoip', 'first_name', 'last_name', 'email', 'street_address', 'city', 'postal_code',
      'country', 'countries'
    ], field => vm[field] = vm.config[field] );

    // Normally we default to GBP, but we must default to a currency that has presets.
    var presetsInUse = [];
    var presets = this.config.presets.oneoff || this.config.presets.regular;
    if (presets) {
      foreach(presets, (p, currency) => { if (p.length) {presetsInUse.push(currency);} });
    }
    if (presetsInUse.indexOf(this.currency) === -1 && presetsInUse.length > 0) {
      // Select the first available currency.
      this.currency = presetsInUse[0];
    }
    foreach(this.config.presets.h)
    console.log(JSON.parse(JSON.stringify(this.config.presets)));
    console.log(JSON.parse(JSON.stringify(presetsInUse)));
  },
  computed: {
    box_title() {
      return this.recur === 'regular' ? 'Monthly' : 'One Off';
    }
  },
  methods: {
    updateAmount(e, recur) {
      // This fires with 'undefined' amount when the subcomponent is destroyed
      // which we need to avoid.
      if (e.amount) {
        this['amount_' + recur] = e.amount;
      }
      this.currency=e.currency;
    },
    amountPresetClicked(e, recur) {
      this.updateAmount(e, recur);
      this.recur = recur;
      this.step ='step2';
    },
    updateNameAddress(e) {
      const vm=this;
      foreach(['first_name', 'last_name', 'email', 'street_address', 'city', 'postal_code', 'country'],
        fld => vm[fld] = e[fld]);
    },
    moveToStep2(recur, amount) {
      if (amount < 1) {
        alert("Amount is below the minimum of 1.00.");
        return;
      }
      this.recur=recur;
      this.step='step2';
    },
    startPayment() {
      var errors = [];
      if (!this.first_name || !this.last_name) {
        errors.push("Please give your full name.");
      }
      if (!this.email) {
        errors.push("Please give your email.");
      }
      if (!this.street_address || !this.postal_code || !this.city) {
        errors.push("Please give your full address.");
      }
      if (this.consent === null) {
        errors.push("Please confirm whether you want the newsletter or not.");
      }
      if (this['amount_' + this.recur] < 1) {
        errors.push("Please enter an amount. 1.00 minimum.");
      }
      if (errors.length > 0) {
        alert(errors.join("\n"));
        return;
      }

      this.step = 'step3';
      // OK.
      const data={};
      data.email = this.email;
      data.amount = this['amount_' + this.recur];
      data.nid = this.nid;
      data.geo = this.geo;
      data.source = this.source;
      data.first_name = this.first_name;
      data.last_name = this.last_name;
      data.street_address = this.street_address;
      data.city = this.city;
      data.postal_code = this.postal_code;
      data.country = this.country;
      data.currency = this.currency;
      data.giftaid = this.giftaid ? 1 : 0;
      data.consent = this.consent ? 1 : 0;
      data.is_recur = (this.recur === 'regular') ? 1 : 0;
      data.test_mode = this.test_mode;
      console.log("sending", data);

      Axios.post('/oddd/api', data)
      .then(response => {
        console.log("got response", response);
        if (response.data.url) {
          window.location = response.data.url;
        }
      })
      .catch( error => {
        var user_message = 'Sorry there was a problem, please try again and let us know if this persists.';
        if (error.response) {
          // Got reply.
          console.log(error.response.data);
          if (error.response.data && error.response.data.user_error) {
            user_message = error.response.data.user_error;
          }
        }
        else if (error.request) {
          console.log('Request made but no response', error);
        }
        else {
          console.log('Network error');
        }
        this.step = 'step2';
        alert(user_message);
      });
    }
  },
}
</script>
