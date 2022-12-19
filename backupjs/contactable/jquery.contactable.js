//extend the plugin
(function($){

	//define the new for the plugin ans how to call it	
	$.fn.contactable = function(options) {
		//set default options  
		var defaults = {
			message : 'Message',
			subject : 'A contactable message',
			recievedMsg : 'Thank you for your message',
			notRecievedMsg : 'Sorry but your message could not be sent, try again later',
			disclaimer: 'Please feel free to get in touch, we value your feedback',
			hideOnSubmit: false
		};

		//call in the default otions
		var options = $.extend(defaults, options);
		//act upon the element that is passed into the design    
		return this.each(function(options) {
			//construct the form
			$(this).html('<div id="contactable"></div><form id="contactForm" method="" action=""><div id="loading"></div><div id="callback"></div><div class="holder"><p><label for="comment">Your Feedback <span class="red"> * </span></label><br /><textarea id="comment" name="comment" class="comment" rows="4" cols="30" ></textarea></p><p><input class="submit" type="submit" value="Send"/></p><p class="disclaimer">'+defaults.disclaimer+'</p></div></form>');
			//show / hide function
			$('div#contactable').toggle(function() {
				$('#overlay').css({display: 'block'});
				$(this).animate({"marginRight": "-=5px"}, "fast"); 
				$('#contactForm').animate({"marginRight": "-=0px"}, "fast");
				$(this).animate({"marginRight": "+=387px"}, "slow"); 
				$('#contactForm').animate({"marginRight": "+=390px"}, "slow"); 
			}, 
			function() {
				$('#contactForm').animate({"marginRight": "-=390px"}, "slow");
				$(this).animate({"marginRight": "-=387px"}, "slow").animate({"marginRight": "+=5px"}, "fast"); 
				$('#overlay').css({display: 'none'});
			});
			
			//validate the form 
			$("#contactForm").validate({
				//set the rules for the fild names
				rules: {
					comment: {
						required: true
					}
				},
				//set messages to appear inline
				messages: {
					comment: ""
				},		
				submitHandler: function() {
					$('.holder').hide();
					$('#loading').show();
					$.post('Cont_Adm.php',{subject:defaults.subject, comment:$('#comment').val()},
						function(data){
							$('#loading').css({display:'none'}); 
							if( data == 'success') {
								$('#callback').show().append(defaults.recievedMsg);
								if(defaults.hideOnSubmit == true) {
									//hide the tab after successful submition if requested
									$('#contactForm').animate({dummy:1}, 2000).animate({"marginLeft": "-=450px"}, "slow");
									$('div#contactable').animate({dummy:1}, 2000).animate({"marginLeft": "-=447px"}, "slow").animate({"marginLeft": "+=5px"}, "fast"); 
									$('#overlay').css({display: 'none'});	
								}
								setTimeout(function(){
									$('#callback').hide();
									$('.holder').show();
								},2000);								
								document.getElementById("comment").value="";
							} else $('#callback').show().append(defaults.notRecievedMsg);						
						}
					);		
				} // close handler
			}); // close validate
		});
	};
})(jQuery);

