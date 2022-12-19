YUI.add('show-password', function(Y) {
  if (Y.one('html').hasClass('modern') && !Y.one('html').hasClass('lt-ie9')) {
    var showPassword = Y.one('#show-password'),
      password = Y.one('#password'),
      //showPasswordIcon = Y.one('#show-password-icon'),
      showPasswordLabel = Y.one('#show-password-label'),
      currentLabel,
      toggleText,
      togglePasswordMask;

    
    togglePasswordMask = function(e) {
     e.halt();
      currentLabel = showPasswordLabel.get('innerHTML');
      toggleText = showPasswordLabel.getAttribute('toggletext');
      if(password.get('type') === 'password') {
        password.set('type', 'text');
        showPasswordLabel.setAttribute('aria-checked', 'true');
      } else {
        password.set('type', 'password');
        showPasswordLabel.setAttribute('aria-checked', 'false');
      }
      showPasswordLabel.set('innerHTML', toggleText);
      showPasswordLabel.setAttribute('toggletext', currentLabel);
    };

    if(showPassword){
      showPassword.setStyle('display', 'block');
    }

    Y.on('mousedown', togglePasswordMask, '#show-password');
  }
});