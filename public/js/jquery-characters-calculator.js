(function ($) {
	$.calculate = function (element, callback, options) {
		options = $.extend({    
			limit: 0,    
			whitespaces: true  
		}, options);
		var $element = $(element);
		if (!$element.is('input,select,textarea')) {
			throw new Error(`Invalid element type: ${element.tagName}!`);
		}
		$element.on('paste keyup keypress change', function () {
			var text = (options.whitespaces ? $element.val().replace(/\s/g, '') : $element.val());
			return callback(text.length, options.limit)
		});
	}
	$.fn.calculate = function (callback, options) {
		return this.each(function () {
			$.calculate(this, callback, options);
		});
	}
})(jQuery);