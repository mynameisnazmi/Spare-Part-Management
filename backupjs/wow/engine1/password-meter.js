YUI.add('password-meter', function(Y) {

  var PasswordMeter = function(config) {
    // throw error if password node is not present
    this.passwordNode = config.passwordNode;
    this.passwordStrength;
    this.validationFunctions = config.validationFunctions;
    this.passwordScoreThreshold = config.passwordScoreThreshold;
    this.fields = config.fields;
  };

  Y.mix(PasswordMeter.prototype, {
    injectPasswordMeter : function(passwordNode) {
      var parentNode = passwordNode.get('parentNode'),
        passwordMeterMarkup = '<div id="password-meter-box" class="password-meter-box"><div id="password-meter" class="password-meter"></div></div>';

      parentNode.append(passwordMeterMarkup);
      parentNode.setStyle('position', 'relative');

      this.passwordMeterBox = Y.one('#password-meter-box');
      this.passwordMeter = Y.one('#password-meter');
    },

    showHidePasswordMeter : function(e, context, display) {
      var _this = context,
        passwordMeterBox = _this.passwordMeterBox;
      passwordMeterBox.setStyle('display', display);
    },

    updatePasswordMeter : function(e, context) {
      var _this = context,
        validationFunctions = _this.validationFunctions,
        passwordMeter = _this.passwordMeter,
        passwordNode = _this.passwordNode,
        passwordValue = passwordNode.get('value'),
        passwordStrength,
        passwordScoreThreshold = _this.passwordScoreThreshold;

      passwordStrength = validationFunctions.calculatePasswordStrength(passwordValue, {
        firstName : _this.fields.FIRST_NAME,
        lastName : _this.fields.LAST_NAME,
        userName : _this.fields.YID,
        passwordScoreThreshold : passwordScoreThreshold
      });
      passwordMeter.removeClass(_this.passwordStrength);
      passwordStrength = passwordStrength.toLowerCase();
      _this.passwordStrength = passwordStrength;
      passwordMeter.addClass(passwordStrength);
    },

    init : function() {
      var _this = this,
        passwordNode = _this.passwordNode;

      _this.injectPasswordMeter(passwordNode);

      passwordNode.on('focus', _this.showHidePasswordMeter, null, _this, 'block');
      passwordNode.on('blur', _this.showHidePasswordMeter, null, _this, 'none');

      passwordNode.on('keyup', _this.updatePasswordMeter, null, _this);
    }
  }, true);

  Y.namespace('Widgets');
  Y.Widgets.PasswordMeter = PasswordMeter;

}, {requires : ['node', 'event-valuechange']});