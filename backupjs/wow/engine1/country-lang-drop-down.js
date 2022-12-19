YUI.add('country-lang-drop-down', function(Y) {
  if (Y.one('html').hasClass('modern')) {

    var target, parent, arrowContainer, optionTextContainer, selectedIndex, updateOptionText;

    target = Y.one('[data=country-lang-drop-down]');

    if(target) {
      parent = target.get('parentNode');

      optionTextContainer = Y.Node.create('<div class="country-lang-drop-down" aria-hidden="true"></div>');
      arrowContainer = Y.Node.create('<div class="country-lang-arrow-container"><div class="bottom-dd-arrow"></div></div>');

      parent.insertBefore(optionTextContainer, target);
      parent.insertBefore(arrowContainer, target);

      target.setStyle('opacity', 0);
      // IE 8 fixes
      target.setStyle('position', 'relative');
      target.setStyle('z-index', 100);

      updateOptionText = function() {
        var selectedIndex = target.get('selectedIndex');
        optionTextContainer.set('innerHTML', target.get('children').item(selectedIndex).get('innerHTML'));
        optionTextContainer.set('dir', target.get('children').item(selectedIndex).get('dir'));
      };

      updateOptionText();

      target.on('change', updateOptionText);
      //FF fix
      target.on('keyup', updateOptionText);

      target.on('focus', function(){
        optionTextContainer.addClass('highlight-border');
      });

      target.on('blur', function(){
        optionTextContainer.removeClass('highlight-border');
      });

    }
  }
});