(function($){$(() => {

  // Use the campaign select to provide the campaign text field.
  var $real_campaign = $('#edit-field-campaign-und-0-value').hide();
  var $select_campaign = $('#edit-campaign-select');
  $select_campaign.val($real_campaign.val());
  $select_campaign.on('change', e => { $real_campaign.val($select_campaign.val()); });
  $select_campaign.insertAfter($real_campaign);

  // Use the mailing_list_select to provide the campaign text field.
  var $real_mailing_list = $('#edit-field-mailing-list-und-0-value').hide();
  var $select_mailing_list = $('#edit-mailing-list-select');
  $select_mailing_list.val($real_mailing_list.val());
  $select_mailing_list.on('change', e => { $real_mailing_list.val($select_mailing_list.val()); });
  $select_mailing_list.insertAfter($real_mailing_list);

  // Use the project select to provide the campaign text field.
  var $real_project = $('#edit-field-project-und-0-value').hide();
  var $select_project = $('#edit-project-select');
  $select_project.val($real_project.val());
  $select_project.on('change', e => { $real_project.val($select_project.val()); });
  $select_project.insertAfter($real_project);

  // Use the thank_you_msg_tpl_select to provide the thank you text field.
  var $real_msg_tpl = $('#edit-field-thank-you-tpl-und-0-value').hide();
  var $select_msg_tpl = $('#edit-msg-tpl-select');
  $select_msg_tpl.val($real_msg_tpl.val());
  $select_msg_tpl.on('change', e => { $real_msg_tpl.val($select_msg_tpl.val()); });
  $select_msg_tpl.insertAfter($real_msg_tpl);

  // Add some validation to the edit-field-funding-deadline-und-0-value field
  var deadline_input = document.getElementById('edit-field-funding-deadline-und-0-value');
  deadline_input.style.display = 'none';
  var deadlineVueAppDiv = document.createElement('DIV');
  deadline_input.insertAdjacentElement('afterend', deadlineVueAppDiv);
  var dateValidator = new Vue({
    el: deadlineVueAppDiv,
    data: { realInput: deadline_input, userInput: deadline_input.value },
    template: `
      <div>
        <input :style="messageStyle" v-model="userInput" type="text" size=32 class="form-text" /><span :style="messageStyle" >{{message}}</span>
      </div>
    `,
    computed: {
      isValid() {
        if (!this.userInput) {
          return true;
        }
        if (this.userInput.match(/^\d{4}-\d\d-\d\d( \d\d:\d\d(:\d\d)?)?$/)) {
          // Copy to real input.
          this.realInput.value = this.userInput;
          return true;
        }
        return false;
      },
      message() {
        if (!this.userInput) {
          return '';
        }
        if (!this.isValid) {
          return '✖ Invalid';
        }
        return '✔';
      },
      messageStyle() {
        return {
          color: this.isValid ? '#0a0' : '#b00'
        };
      }
    }
  })

  // Convert the json field into something nicer.
  var $presetsInput = $('#edit-field-presets-und-0-value').hide();
  var editor = $('<div/>')[0];
  $presetsInput.after(editor);

  if (!$presetsInput.val()) {
    $presetsInput.val('{}');
  }

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
