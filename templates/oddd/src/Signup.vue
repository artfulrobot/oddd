<template>
  <div class="odd__signup-form">
    <name-address
      @updated="updateNameAddress"
      v-bind="{first_name, last_name, email, include_address: false, errors: visibleErrors}"
      ></name-address>
    <br/>
    <div class="odd__next-button-wrapper" >
      <button
        :disabled="errorCount > 0 && !busy"
         class="odd__next-button"
         @click.prevent="processSignup()">Sign Up</button> <i class="od-spinner" v-show="busy"></i>
    </div>
  </div>
</template>

<script>
import Axios from 'axios';
import NameAddress from './NameAddress.vue';
export default {
  components: {NameAddress},
  props: [ 'config' ],
  data() {
    return {
      'first_name': 'Rich',
      'last_name': 'Lott',
      'email': 'forums@artfulrobot.uk',
      'entered': {},
      'busy': false,
    };
  },
  computed: {
    errors() {
      console.log("recalc errors");
      const errors = {};
      if (!this.first_name) {
        errors.first_name = 'Required';
      }
      if (!this.last_name) {
        errors.last_name = 'Required';
      }
      if (!this.email || this.email.indexOf('@') === -1) {
        errors.email = 'Valid email required';
      }
      return errors;
    },
    visibleErrors() {
      const errors = this.errors;
      const visibleErrors = {};
      ['first_name', 'last_name', 'email']
      .forEach(fld => {
        if (this.entered[fld] && fld in errors) {
          visibleErrors[fld] = errors[fld];
        }
      });
      return visibleErrors;
    },
    errorCount() {
      return Object.values(this.errors).length;
    }
  },
  methods: {
    updateNameAddress(e) {
      // Copies the updated values into our data.
      ['first_name', 'last_name', 'email']
        .forEach(fld => { this[fld] = (e[fld] ? e[fld].replace(/^\s*(.*?)\s*$/, '$1') : ''); } );
      this.entered = Object.assign({}, e.entered);
    },
    processSignup() {
      ['first_name', 'last_name', 'email'].forEach(fld => {this.$set(this.entered, fld, true);});
      if (this.errorCount > 0) {
        return;
      }
      this.busy = true;

      const data={
        service: 'signup',
        email: this.email,
        first_name: this.first_name,
        last_name: this.last_name,
        source: this.source,
        nid: this.config.nid,
      };
      Axios.post('/oddd/api', data)
      .then(response => {
        console.log("initial response: ", response.data);
        if (response.data.signature) {
          data.signature = response.data.signature;
          return Axios.post('/oddd/api', data);
        }
        else {
          this.busy = false;
          console.warn("ah shit 4");
          throw "Failed to obtain signature.";
        }
      })
      .then(response => {
        console.log("got response 2", response.data);
        if (! response.data.error) {
          this.$emit('completed', {
            first_name: this.first_name,
            last_name: this.last_name,
            email: this.email,
            consent: 1, // by its nature.
          });
          this.busy = false;
        }
        else {
          this.busy = false;
          console.warn("ah shit 2");
          throw "Failed submitting final request.";
        }
      })
      .catch( error => {

        this.busy = false;
        var user_message = 'Sorry there was a problem, please try again and let us know if this persists.';
        if (typeof error === 'object') {
          if (error.response) {
            // Got reply.
            console.log(error.response.data);
            if (error.response.data && error.response.data.user_error) {
              user_message = error.response.data.user_error;
            }
          } else if (error.request) {
            console.log('Request made but no response', error);
          } else {
            console.log('Network error');
          }
        }
        else {
          console.error(error);
        }
        alert(user_message);
      });
    }
  }
};
</script>
