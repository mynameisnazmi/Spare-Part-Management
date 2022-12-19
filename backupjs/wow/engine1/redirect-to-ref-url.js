YUI.add('redirect-to-ref-url', function (Y) {

  var timer, id,
    timerMessageNode = Y.one('#timer-message'),
    timerMessages = Y.Membership.ValidationMessages.TIMER_MESSAGES,
    counter = timerMessages.length - 1,
    redirectURL = Y.Membership.AppSpecificConstraint.REDIRECT_URL;

  timer = function() {
    if(counter > -1) {
      timerMessageNode.set('innerHTML', timerMessages[counter]);
      counter--;
      setTimeout(timer, 1000);
    } else {
      document.location = redirectURL;
    }
  };

  setTimeout(timer, 1000);
}, {requires: ['validation-messages', 'app-specific-constraint']});