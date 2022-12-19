YUI.add('birthday-drop-down', function(Y) {
	if (Y.one('html').hasClass('modern')) {
		Y.all('[data=birthday-drop-down]').each(function(target) {
			var parent, arrowContainer, optionTextContainer, updateOptionText;
			parent = target.get('parentNode');
			optionTextContainer = Y.Node.create('<div class="birthday-drop-down" aria-hidden="true"></div>');
			arrowContainer = Y.Node.create('<div class="arrow-container"><div class="bottom-dd-arrow"></div></div>');

			parent.insertBefore(optionTextContainer, target);
			parent.insertBefore(arrowContainer, target);

			target.setStyle('opacity', 0);
			// IE 8 fixes
			target.setStyle('position', 'relative');
			target.setStyle('z-index', 100);

			updateOptionText = function() {
				var selectedIndex = target.get('selectedIndex');
				optionTextContainer.set('innerHTML', target.get('children').item(selectedIndex).get('innerHTML'));

				if(selectedIndex > 0) {
					optionTextContainer.setStyle('color', 'black');
				}
				else	{
						optionTextContainer.setStyle('color', '#b7b7b7');
						}
			};

			updateOptionText();

			target.on('change', updateOptionText);
			//FF fix
			target.on('keyup', updateOptionText);

			target.on('focus', function(){
				optionTextContainer.addClass('highlight-background');
			});

			target.on('blur', function(){
				optionTextContainer.removeClass('highlight-background');
			});
		});
	}
});