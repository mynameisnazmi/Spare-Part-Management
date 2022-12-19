YUI.add('password-strength', function(Y) {

  var passwordStrengthContainer = Y.one('#password-strength'),

    passwordLengthIcon = Y.one('#password-length span'),
    passwordLengthText = Y.one('#password-length'),

    passwordContainsMixedCaseIcon = Y.one('#password-contain-mixed-case span'),
    passwordContainsMixedCaseText = Y.one('#password-contain-mixed-case'),

    passwordContainsNumberSpecialIcon = Y.one('#password-contain-numbers-special span'),
    passwordContainsNumberSpecialText = Y.one('#password-contain-numbers-special'),

    showHidepasswordStrengthContainer, updatePasswordStrength,

    enabledColor = Y.one('html').hasClass('march-madness')? '#fff' : '#000';

  if(passwordStrengthContainer) {
    showHidepasswordStrengthContainer = function(e, display) {
      passwordStrengthContainer.setStyle('display', display);
    };
    Y.on('focus', showHidepasswordStrengthContainer, '#password', null, 'block');

    Y.on('blur', showHidepasswordStrengthContainer, '#password', null, 'none');
  }

  if(passwordLengthIcon && passwordLengthText &&
    passwordContainsMixedCaseIcon && passwordContainsMixedCaseText &&
    passwordContainsNumberSpecialIcon && passwordContainsNumberSpecialText) {

    updatePasswordStrength = function (passwordStrengthIcon, passwordStrengthText, status) {
      if(status) {
        if(passwordStrengthIcon.hasClass('tick-fail')) {
          passwordStrengthIcon.removeClass('tick-fail');
          passwordStrengthIcon.addClass('tick-pass');
          passwordStrengthText.setStyle('color', enabledColor);
        }
      } else {
        if(passwordStrengthIcon.hasClass('tick-pass')) {
          passwordStrengthIcon.removeClass('tick-pass');
          passwordStrengthIcon.addClass('tick-fail');
          passwordStrengthText.setStyle('color', '#a5a5a5');
        }
      }
    };

    Y.on('keyup', function(e){
      var password = this.get('value'),
      passwordLengthStatus,
      passwordContainsMixedCaseStatus,
      passwordContainsNumberSpecialStatus;

      passwordLengthStatus = password.length > 7 ? true : false;
      updatePasswordStrength(passwordLengthIcon, passwordLengthText, passwordLengthStatus);

      passwordContainsMixedCaseStatus = password.match(/[a-z]+/) && password.match(/[A-Z]+/) ? true : false;
      updatePasswordStrength(passwordContainsMixedCaseIcon, passwordContainsMixedCaseText, passwordContainsMixedCaseStatus);

      passwordContainsNumberSpecialStatus = password.match(/\d/) ? true : false;
      updatePasswordStrength(passwordContainsNumberSpecialIcon, passwordContainsNumberSpecialText, passwordContainsNumberSpecialStatus);

    }, '#password');
  }

});