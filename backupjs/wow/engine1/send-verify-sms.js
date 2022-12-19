YUI.add('send-verify-sms', function (Y) {
  var validationMessages = Y.Membership.ValidationMessages,
    smsUrl = Y.Membership.AppSpecificConstraint.SEND_SMS_URL,

    mobile = Y.one('#mobile'), countryCode = Y.one('#country-code'),
    u = Y.one('#u'), t = Y.one('#t'),
    sendingSmsTextNode = Y.one('#sending-sms-text'), sendingSmsText = sendingSmsTextNode.get('innerHTML'),
    sendSmsSubmit = Y.one('#send-sms-submit'),
    mobileValidationMessage = Y.one('#mobile-validation-message'),
    verificationForm = Y.one('#verify-form'),
    verificationCode = Y.one('#verification-code'),
    verificationCodeValidationMessage = Y.one('#verification-code-validation-message'),
    complete;

  sendingSmsTextNode.set('innerHTML', '');
  sendingSmsTextNode.setStyle('display', 'block');

  complete = function(id, response) {
    if(response.status === 200) {
      try {
        sendSMSResponse = Y.JSON.parse(response.responseText);
        sendingSmsTextNode.set('innerHTML', '');
        u.set('value', sendSMSResponse.u);
        t.set('value', sendSMSResponse.t);
        switch(sendSMSResponse.StatusCode) {
          case  "100" :
            verificationForm.setStyle('display', 'block');
            verificationCode.setStyle('display', 'block');
            verificationCode.focus();
            break;
          case  "99" :
          case  "101" :
          case  "106" :
          case  "107" :
            mobileValidationMessage.set('innerHTML', validationMessages['SMS_STATUS_'+sendSMSResponse.StatusCode]);
            sendSmsSubmit.setStyle('display', 'block');
            break;
          case  "102" :
          case  "103" :
          case  "104" :
          case  "105" :
            verificationForm.submit();
            break;
          default:
            mobileValidationMessage.set('innerHTML', validationMessages.SMS_GENERIC_ERROR);
            sendSmsSubmit.setStyle('display', 'block');
            break;
        }
      } catch (error){
        mobileValidationMessage.set('innerHTML', validationMessages.SMS_GENERIC_ERROR);
        sendSmsSubmit.setStyle('display', 'block');
      }
    } else {
      mobileValidationMessage.set('innerHTML', validationMessages.SMS_GENERIC_ERROR);
      sendSmsSubmit.setStyle('display', 'block');
    }
  };

  Y.on('send-sms:submitted', function(){
    if(Y.Membership.ValidationTargets.MOBILE.status) {
      mobile.blur();
      sendingSmsTextNode.set('innerHTML', sendingSmsText);
      Y.one('#send-sms-submit').setStyle('display', 'none');
      Y.io(smsUrl, {method : "POST", form: {id: 'verify-form'}, on: {complete: complete}});
    }
  });

  Y.on('click', function(){
    // this is horibble code
    verificationCode.removeClass('error');
    verificationCodeValidationMessage.set('innerHTML', '');
    Y.Membership.ValidationTargets.VERIFICATION_CODE.validationMessage = '';
    sendingSmsTextNode.set('innerHTML', sendingSmsText);
    verificationForm.setStyle('display', 'none');
    verificationCode.setStyle('display', 'none');
    Y.io(smsUrl, {method : "POST", form: {id: 'verify-form'}, on: {complete: complete}});
  }, '#send-new-code');

  // some stupid code that I dont wanna refactor.

  Y.on('keyup', function(){
    Y.one('#dummy-mobile').set('value', this.get('value'));
  }, '#mobile');

  Y.on('change', function(){
    Y.one('#dummy-country-code').set('value', this.get('value'));
  }, '#country-code');

  Y.on('mousedown', function(e){
    e.halt();
    mobile.removeAttribute('readonly');
    mobile.removeClass('readonly');
    this.get('parentNode').set('innerHTML',this.get('parentNode').get('innerHTML').replace(/<.*>/, '' + this.get('innerHTML')));
  }, '#edit-mobile-number');

}, {requires:['app-specific-constraint', 'validation-messages', 'validation-targets']});