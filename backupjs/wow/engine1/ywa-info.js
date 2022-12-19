YUI.add('ywa-info', function(Y) {

  var fields = [],
    validationTargets = Y.Membership.ValidationTargets,
    index, focusEventHandler, blurEventHandler;

  fields = [
    validationTargets.FIRST_NAME.id,
    validationTargets.LAST_NAME.id,
    validationTargets.YID.id,
    validationTargets.PASSWORD.id,
    validationTargets.MOBILE.id
  ];

  focusEventHandler = function(e) {
    ins.beaconEvent("ENTER_FIELD", {fieldname: e.target.get('id')});
  };

  for(index in fields) {
    Y.on('focus', focusEventHandler, fields[index]);
  }

  blurEventHandler = function(e) {
    ins.beaconEvent("EXIT_FIELD", {fieldname: e.target.get('id')});
  };

  for(index in fields) {
    Y.on('blur', blurEventHandler, fields[index]);
  }

  Y.on('change', function(e){
    ins.beaconEvent("CC_MODIFIED");
  }, validationTargets.COUNTRY_CODE.id);

});