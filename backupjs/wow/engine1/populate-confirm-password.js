YUI.add('populate-confirm-password', function(Y) {

  var confirmPassword = Y.one('#confirm-password');

  if(confirmPassword){
    Y.on('keyup', function(){
      confirmPassword.set('value', this.get('value'));
    }, '#password');
  }

});