<template>
<div>
  <div class="odd__container">
    <div class="odd__page">
      <div class="odd__body-text" v-html="body" />
    </div>
    <div class="odd__forms">
      <div v-if="regular_or_one[1] === 'r' && step==='step1'" class="odd__form">

        <h2>Make a regular donation</h2>
        <amounts :allPresets="presets" recur="regular"
                 v-bind="{currency, amount: amount_regular, geo}"
                 @updated="updateAmount($event, 'regular')"
                 @finished="amountPresetClicked($event, 'regular')"
                 ></amounts>

        <p>Regular support makes the biggest difference. It means we can keep people in jobs, doing more ambitious, long-term investigations – the 'heavy lifting' that most newspapers don't do any more. Thank you.</p>

        <button :disabled="!amount_regular" class="odd__next-button" @click.prevent="moveToStep2('regular', amount_regular)">Next</button>
      </div>

      <div v-if="regular_or_one[0] === 'o' && step==='step1'" class="odd__form">
        <h2>Make a single donation</h2>
        <amounts :allPresets="presets" recur="oneoff"
                  v-bind="{currency, amount: amount_oneoff, geo}"
                  @updated="updateAmount($event, 'oneoff')"
                  @finished="amountPresetClicked($event, 'oneoff')"
                  ></amounts>
        <button :disabled="!amount_oneoff" class="odd__next-button" @click.prevent="moveToStep2('oneoff', amount_oneoff)">Next</button>
      </div>


      <div v-show="step==='step2'" class="odd__form">
        <h2>{{box_title}}</h2>
        <button @click.prevent="step='step1';recur=null;"  class="odd__back-button" >Back</button>
        <name-address
          @updated="updateNameAddress"
          v-bind="{geo, first_name, last_name, email, street_address, city, postal_code, country, countries, include_address, errors}"
          />
        <div v-if="geo === 'GB' && legal_entity === 'charity' && include_address" class="odd__giftaid">
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
        <span style="display:none;">Mailinglist {{mailing_list}}</span>
        <div :class="{invalid: !!errors.consent}" style="margin-top:2rem;"
          v-if="mailing_list > 0"
          >
          <p>Shall we add you to our email newsletter list? You can unsubscribe at any time.</p>
          <div class="odd__checkbox">
            <input value="1" type="radio" :name="'consent' + id" v-model="consent" :id="'consent-y' + id" />
            <label :for="'consent-y' + id" >Yes please</label>
          </div>
          <div class="odd__checkbox">
            <input value="0" type="radio" :name="'consent' + id" v-model="consent" :id="'consent-n' + id" />
            <label :for="'consent-n' + id" >I'm already on it, or I don't want to be signed up.</label>
          </div>
          <div class="invalid-msg" v-if="errors.consent">{{errors.consent}}</div>
        </div>
        <div class="odd__donate-button">
          <p v-if="legal_entity === 'charity'" class="odd__opentrust">
            The openTrust is a UK-registered charity (#1086404) that supports openDemocracy's charitable activities.
          </p>
          <button @click.prevent="startPayment" >Donate</button>
        </div>
      </div>

      <div v-show="step==='step3'" class="odd__form">
        <h2>{{box_title}}</h2>
        <p>Just a mo, redirecting you to the secure payment page...</p>
      </div>
    </div>
  </div>
  <div class="odd__extra-wrapper">
    <a class="show-more" href v-if="extra && !showExtra" @click.prevent="showExtra = true">Other Ways To Give</a>
    <div class="odd__extra-text" v-html="extra" v-show="showExtra"/>
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
      errors: {},
      showExtra: false,

      test_mode: false,

      'title' : null,
      'nid' : null,
      'geo' : null,
      'body' : null,
      'extra' : null,
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
      'include_address': null,
      'mailing_list': null,
    };
  },
  props: [ 'config' ],
  created() {
    const vm = this;
    foreach([
      'title', 'nid', 'geo', 'body', 'extra', 'source', 'regular_or_one', 'presets', 'legal_entity',
      'geoip', 'first_name', 'last_name', 'email', 'street_address', 'city', 'postal_code',
      'country', 'countries', 'include_address', 'mailing_list'
    ], field => vm[field] = vm.config[field] );

    // Check what currencies are in use by presets.
    var presetsInUse = [];
    function collect(presets) {
      if (presets) {
        foreach(presets, (p, currency) => { if (p.length) {presetsInUse.push(currency);} });
      }
    }
    collect(this.config.presets.oneoff);
    collect(this.config.presets.regular);

    // Select preferred currency.
    this.currency = this.geo === 'GB' ? 'GBP' : this.geo === 'US' ? 'USD' : 'EUR';

    // Check it has presets, otherwise just use the first available currency.
    if (presetsInUse.indexOf(this.currency) === -1 && presetsInUse.length > 0) {
      // Select the first available currency.
      this.currency = presetsInUse[0];
    }
  },
  computed: {
    box_title() {
      return this.recur === 'regular' ? 'Make a regular donation' : 'Make a single donation';
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
      console.log("moveToStep2", amount);
      if (!amount.match(/^\d+(\.\d?\d?)?$/)) {
        alert("Please correct amount.");
        return;
      }
      if (amount < 1) {
        alert("Amount is below the minimum of 1.00.");
        return;
      }
      this.recur=recur;
      this.step='step2';
    },
    startPayment() {
      const errors = {};

      const requiredInputs = (fields) => {
        fields.forEach(pair => { if (!this[pair[0]]) errors[pair[0]] = pair[1]; });
      };

      requiredInputs([
        ['first_name' , 'Required'],
        ['last_name' , 'Required'],
        ['email' , 'Required'],
      ]);
      if (this.include_address) {
        requiredInputs([
          ['street_address' , 'Required'],
          ['city' , 'Required'],
          ['postal_code' , 'Required'],
        ]);
      }
      if (this.mailing_list > 0) {
        requiredInputs([ ['consent' , 'Please confirm your preference'] ]);
      }

      if (this['amount_' + this.recur] < 1) {
        errors['amount_' + this.recur] = "Please enter an amount. 1.00 minimum.";
      }
      this.errors = errors;
      if (Object.keys(errors).length > 0) {
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
