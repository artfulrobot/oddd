import Vue from 'vue';
import Axios from 'axios';
import Odd from './Odd.vue';
document.addEventListener('DOMContentLoaded', () => {
  jQuery('.odd-node').each(function(){
    const c = JSON.parse(this.dataset.config);
    console.log(c);
    const app = new Vue({
      'el': this,
      render: h => h(Odd, {props: {config: c}})
    });
  })
});
