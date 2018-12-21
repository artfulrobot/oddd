<template>
  <div>
    <div class="odd__input-pair">
      <div class="odd__textfield">
        <label :for="id + '_first_name'">First Name</label>
        <input :id="id + '_first_name'" v-model='workingData.first_name' />
      </div>
      <div class="odd__textfield">
        <label :for="id + '_last_name'">Last Name</label>
        <input :id="id + '_last_name'" v-model='workingData.last_name' />
      </div>
    </div>
    <div class="odd__textfield">
      <label :for="id + '_email'">Email</label>
      <input :id="id + '_email'" v-model='workingData.email' />
    </div>
    <div class="odd__textfield">
      <label :for="id + '_street_address'">Address</label>
      <input :id="id + '_street_address'" v-model='workingData.street_address' />
    </div>
    <div class="odd__input-pair">
      <div class="odd__textfield">
        <label :for="id + '_city'">City</label>
        <input :id="id + '_city'" v-model='workingData.city' />
      </div>
      <div class="odd__textfield">
        <label :for="id + '_postal_code'">Post Code</label>
        <input :id="id + '_postal_code'" v-model='workingData.postal_code' />
      </div>
    </div>
    <div class="odd__selectfield" v-if="geo !== 'GB'">
      <label :for="id+'_country'">Country</label>
      <select v-model='workingData.country' :id="id+'_country'">
        <option v-for="(name, code) in countries" :value="code" >{{name}}</option>
      </select>
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
  ],
  mounted () {
    this.id = this._uid;
    console.log("mounted1, workingData is ", JSON.stringify(this.workingData));
    console.log("mounted1, first name", JSON.stringify(this.first_name));
    this.workingData = {
      'first_name': this.first_name,
      'last_name': this.last_name,
      'street_address': this.street_address,
      'email': this.email,
      'city': this.city,
      'postal_code': this.postal_code,
      'country': this.country,
    };
    console.log("mounted2, workingData is ", JSON.stringify(this.workingData));
  },
  watch: {
    workingData: {
      handler(new_val) {
        console.log("watch changed workingData");
        this.$emit('updated', new_val);
      },
      deep: 1,
    }
  }
};
</script>
