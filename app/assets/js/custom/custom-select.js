function updateCustomSelect(selector) {

	var customSelects = $(selector);

	customSelects.each(function() {
		var $this = $(this),
			select = $this.find('select'),
			selectAlias = $this.find('span'),
			selectedText = select.find('option:selected').text();

		selectAlias.text(selectedText);
	});
}

$(document).ready(function() {
	updateCustomSelect('.custom-select');

	$('.custom-select select').on('change', function() {
		var select = $(this),
			selectAlias = select.siblings('span'),
			selectedText = select.find('option:selected').text();

		selectAlias.text(selectedText);

	});
});

