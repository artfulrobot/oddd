import Vue from 'vue';
import DonationUx from './DonationUx.vue';
import SignupUx from './SignupUx.vue';
import './styles.scss';

// Vue.config.productionTip = false;

// Polyfill Object.values for ie!
if (typeof Object.values === 'undefined') {
  Object.values = (obj) => {
    var values = [];
    Object.keys(obj).forEach(k => { if (obj.hasOwnProperty(k)) { values.push(obj[k]); }});
    return values;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  Array.prototype.forEach.call(document.getElementsByClassName('odd-node'), function(el, index, array){
    const c = JSON.parse(el.dataset.config);
    window.oddcConfig = c;

    // Select the main UX object.
    var ux = {
      'donation-1': DonationUx,
      'signup-share-donate-1': SignupUx,
    }[c.ux || 'donation-1'] || null;

    /* eslint no-unused-vars: 0 */
    const app = new Vue({ 'el': el, render: h => h(ux, {props: {config: c}}) });
    if (c.mode === 'test') {
      document.body.classList.add('od-test-mode');
    }
  });
});
