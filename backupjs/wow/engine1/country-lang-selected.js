YUI.add('country-lang-selected', function (Y) {

  var updateCountryLangPreference = function(){
    var currentOption;

    currentOption = this.all('option').item(this.get('selectedIndex'));

    Y.one('#lang').set('value', currentOption.getAttribute('lang'));
    Y.one('#intl').set('value', currentOption.getAttribute('intl'));
    // this should be a link instead of form submit.
    // remove the i-agree-button
    Y.one('#i-agree-button').remove();
    Y.one('#info-form').submit();
  };

  Y.on('change', updateCountryLangPreference, '#country-lang');
});