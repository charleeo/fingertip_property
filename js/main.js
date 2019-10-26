$(document).ready(function() {
	$('#submit').click(function(e) {
		var keyWords = $('#search-key-words').val();
		var value = $('#selected_element').val();
		var data = $('#dlist [value="' + value + '"]').data('value');

		if (keyWords == '') {
			alert('Please enter a key word in text box');
			return false;
		} else if (value == '') {
			alert('Please select a region');
			return false;
		}

		$('#locate').val(data);
		return true;
	});

	// confirm deletion
	$('a.delete').click(function(event) {
		if (!confirm('You are about to delete this image. Click Ok to continue or cancel to return')) {
			event.preventDefault();
			return false;
		}
		return true;
	});
});
var x,
	sec = 6;
x = setInterval(myFunc, 1000);
function myFunc() {
	sec--;
	if (sec <= 1) {
		document.getElementById('timer').style.display = 'none';
		clearInterval(x);
	}
}

$('#selected_element').on('keyup', function(e) {
	var textValue = $('#selected_element').val();

	var option = $('#dlist option')
		.filter(function() {
			return this.value === $('#selected_element').val();
		})
		.val();

	if (option) $('#output').html('');
	else
		$('#output')
			.html(
				'No option matches with ' +
					textValue +
					'. Please  selecting a valid option or type a correct location from the drop down'
			)
			.show()
			.fadeOut(5000);
	if (textValue === '') $('#output').html('');
});

// To display the categorie image above the main heading

$('document').ready(function() {
	$('#category-one').mouseenter(function() {
		$('#category-one-image').show();
	});

	$('#category-one').mouseleave(function() {
		$('#category-one-image').hide();
	});
	// category 2
	$('#category-two').mouseenter(function() {
		$('#category-two-image').show();
	});

	$('#category-two').mouseleave(function() {
		$('#category-two-image').hide();
	});

	// category 3
	$('#category-three').mouseenter(function() {
		$('#category-three-image').show();
	});

	$('#category-three').mouseleave(function() {
		$('#category-three-image').hide();
	});

	// category 4
	$('#category-four').mouseenter(function() {
		$('#category-four-image').show();
	});

	$('#category-four').mouseleave(function() {
		$('#category-four-image').hide();
	});
});

// Submit regions filtered result

$('#selected-element').on('keyup', function(e) {
	var textValue = $('#selected-element').val();

	var option = $('#dlist option')
		.filter(function() {
			return this.value === $('#selected-element').val();
		})
		.val();

	if (option) $('#output').html('');
	else
		$('#output')
			.html(
				'No option matches with ' +
					textValue +
					'. Please  selecting a valid option or type a correct location from the drop down'
			)
			.show()
			.fadeOut(5000);
	if (textValue === '') $('#output').html('');
});
$('#submit2').click(function(e) {
	var value = $('#selected-element').val();
	var data = $('#dlist [value="' + value + '"]').data('value');
	$('#locate').val(data);
});
$('#advanced-search').click(function() {
	$('.search-form').toggle();
});
