<template>
  <div>
    <div class="odd__input-pair">
      <div class="odd__textfield" :class="{invalid: !!errors.first_name}">
        <label :for="id + '_first_name'">First Name</label>
        <input :id="id + '_first_name'"
           v-model='workingData.first_name'
           name="first_name"
           autocomplete="given-name" />
        <div v-if="errors.first_name" class="invalid-msg">{{errors.first_name}}</div>
      </div>
      <div class="odd__textfield" :class="{invalid: !!errors.last_name}">
        <label :for="id + '_last_name'">Last Name</label>
        <input :id="id + '_last_name'"
           v-model='workingData.last_name'
           name="last_name"
           autocomplete="family-name"/>
        <div v-if="errors.last_name" class="invalid-msg">{{errors.last_name}}</div>
      </div>
    </div>
    <div class="odd__textfield" :class="{invalid: !!errors.email}">
      <label :for="id + '_email'">Email</label>
      <input :id="id + '_email'"
         v-model='workingData.email'
         name="email"
         autocomplete="email"/>
      <div v-if="errors.email" class="invalid-msg">{{errors.email}}</div>
    </div>

    <div v-if="include_address">
      <div class="odd__textfield" :class="{invalid: !!errors.street_address}">
        <label :for="id + '_street_address'">Address</label>
        <input :id="id + '_street_address'"
           v-model='workingData.street_address'
          name="street_address"
          autocomplete="street-address" />
        <div v-if="errors.street_address" class="invalid-msg">{{errors.street_address}}</div>
      </div>
      <div class="odd__input-pair" :class="{invalid: !!errors.city}">
        <div class="odd__textfield">
          <label :for="id + '_city'">City</label>
          <input :id="id + '_city'"
             v-model='workingData.city'
             name="city"
             autocomplete="address-level2"
             />
          <div v-if="errors.city" class="invalid-msg">{{errors.city}}</div>
        </div>
        <div class="odd__textfield" :class="{invalid: !!errors.first_name}">
          <label :for="id + '_postal_code'">Post Code</label>
          <input :id="id + '_postal_code'"
             v-model='workingData.postal_code'
             name="postal_code"
             autocomplete="postal-code"
             />
          <div v-if="errors.postal_code" class="invalid-msg">{{errors.postal_code}}</div>
        </div>
      </div>
      <div class="odd__selectfield" v-if="geo !== 'GB'">
        <label :for="id+'_country'">Country</label>
        <select v-model='workingData.country' :id="id+'_country'">
          <option v-for="(name, code) in countries" :value="code" :key="code">{{name}}</option>
        </select>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  data() {
    return {
      id: null,
      workingData: {},
    };
  },
  props: [
    'first_name',
    'last_name',
    'email',
    'street_address',
    'city',
    'postal_code',
    'country',
    'countries',
    'geo',
    'include_address',
    'errors'
  ],
  mounted () {
    this.id = this._uid;
    this.workingData = {
      'first_name': this.first_name,
      'last_name': this.last_name,
      'street_address': this.street_address,
      'email': this.email,
      'city': this.city,
      'postal_code': this.postal_code,
      'country': this.country,
    };
  },
  watch: {
    workingData: {
      handler(new_val) {
        this.$emit('updated', new_val);
      },
      deep: 1
    }
  }
};
</script>
