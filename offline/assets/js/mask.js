// Mask Input
	$(function(){ 
		var SPMaskBehavior = function (val) {
		  return val.replace(/\D/g, '').length === 13 ? '(00) 00000-0000' : '(00)-9-0000-0000';
		},
		spOptions = {
		  onKeyPress: function(val, e, field, options) {
			  field.mask(SPMaskBehavior.apply({}, arguments), options);
			}
		};

		$('.fone').mask(SPMaskBehavior, spOptions);
		
		$("#frmContato").validate();
	});