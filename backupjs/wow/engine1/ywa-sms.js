YUI.add('ywa-sms', function(Y) {

  var validationTargets = Y.Membership.ValidationTargets;

  Y.on('focus', function(e){
    ins.beaconEvent("ENTER_FIELD", {fieldname: e.target.get('id')});
  }, validationTargets.MOBILE.id);

  Y.on('blur', function(e){
    ins.beaconEvent("EXIT_FIELD", {fieldname: e.target.get('id')});
  }, validationTargets.MOBILE.id);

  Y.on('change', function(e){
    ins.beaconEvent("CC_MODIFIED");
  }, validationTargets.COUNTRY_CODE.id);

  Y.on('send-sms:submitted', function(e){
    ins.beaconEvent("SEND_SMS");
  });

});