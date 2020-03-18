import Vue from 'vue';
import Odd from './Odd.vue';
import './styles.scss';

// Vue.config.productionTip = false;

document.addEventListener('DOMContentLoaded', () => {
  Array.prototype.forEach.call(document.getElementsByClassName('odd-node'), function(el, index, array){
    const c = JSON.parse(el.dataset.config);
    window.oddcConfig = c;
    /* eslint no-unused-vars: 0 */
    const app = new Vue({
      'el': el,
      render: h => h(Odd, {props: {config: c}})
    });
    if (c.mode === 'test') {
      document.body.classList.add('od-test-mode');
    }
  });
});
