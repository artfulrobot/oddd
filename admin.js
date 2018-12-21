(function($){$(() => {

  // Use the campaign select to provide the campaign text field.
  var $real_campaign = $('#edit-field-campaign-und-0-value').hide();
  var $select_campaign = $('#edit-campaign-select');
  $select_campaign.val($real_campaign.val());
  $select_campaign.on('change', e => {
    $real_campaign.val($select_campaign.val());
  });
  $select_campaign.insertAfter($real_campaign);

  // Convert the json field into something nicer.
  var $presetsInput = $('#edit-field-presets-und-0-value').hide();
  var editor = $('<div/>')[0];
  $presetsInput.after(editor);

  var app = new Vue({
    el: editor,
    data: { presets: JSON.parse($presetsInput.val()) },
    created() {
      // We have to clean up the data.
    },
    methods: {
      addRecur(recur) {
        this.$set(this.presets, recur, {GBP:[], USD:[], EUR: []});
      },
      addCurrency(currency) {
        this.$set(this.presets[recur], recur, {GBP:[], USD:[], EUR: []});
      },
      addOption(recur, currency) {
        if (! (currency in this.presets[recur])) {
          this.$set(this.presets[recur], currency, []);
        }
        this.presets[recur][currency].push('');
      }
    },
    watch: {
      presets: {
        deep: true,
        handler(new_value) {
          $presetsInput.val(JSON.stringify(new_value));
        }
      }
    },
    template: `
    <div>
      <div v-for="recur in ['oneoff', 'regular']" style="border:solid 1px #eee; padding:1rem;">
        <h3>{{recur}}</h3>
        <div v-if="recur in presets" style="display:flex;flex-wrap:wrap;">
          <div v-for="currency in ['GBP', 'USD', 'EUR']" style="flex:0 0 auto; background:#eee;padding:1rem;margin:0.5rem;">
            <div style="border-bottom: solid 2px #aaa;margin-bottom:0.5rem;">Currency: {{currency}}</div>
            <div v-for="(option, optionIdx) in presets[recur][currency]">
              <input class="form-text" size="2" v-model="presets[recur][currency][optionIdx]" />
              <a href @click.prevent="presets[recur][currency].splice(optionIdx, 1)" title="remove">✖</a>
            </div>
            <a href @click.prevent="addOption(recur, currency)">Add another option</a>
          </div>
        </div>
        <div v-else>
          No options <a href @click.prevent="addRecur(recur)">Add options for {{recur}}</a>
        </div>
      </div>
    </div>
    `
  });
})})(jQuery);
