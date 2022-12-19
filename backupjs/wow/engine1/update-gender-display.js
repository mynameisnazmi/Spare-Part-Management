YUI.add('update-gender-display', function(Y) {
  var updateGenderDisplay;

  updateGenderDisplay = function() {
    Y.all('input[type="radio"]').each(function(radio){
      radio.removeClass('error');
    });
    Y.one('#gender-validation-message').set('innerHTML', '');
  };

  Y.once('click', updateGenderDisplay, '#male');
  Y.once('click', updateGenderDisplay, '#female');

});