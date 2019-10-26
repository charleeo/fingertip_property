$('.number').keyup(function(event) {
	// skip for arrow keys
	if (event.which >= 37 && event.which <= 40) return;

	// format number
	$(this).val(function(index, value) {
		return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	});
});

$(document).ready(function() {
	counter = 1;
	var addedNumber = 1;

	$('#add').click(function() {
		counter++;
		id = 'file' + addedNumber;

		if (addedNumber < 20) {
			$('#add_more').append(
				'<div id=' +
					id +
					' class="form-group"><label> Image ' +
					counter +
					"</label> <br/> <input type='file' name='images[]'  multiple></div>"
			);
		} else {
			alert('You have reached the max allowed');
		}

		addedNumber++;
		var removebtn = document.getElementById('removebtn');
		if (counter > 1) {
			removebtn.style.display = 'inline';
		}
	});

	$('#removebtn').click(function() {
		addedNumber--;
		counter--;
		reverseid = '#file' + addedNumber;
		$(reverseid).remove();
		if (counter <= 1) {
			removebtn.style.display = 'none';
		}
	});
});

function _(x) {
	return document.getElementById(x);
}
var purpose = _('purpose');
purpose.addEventListener('change', function() {
	if (this.value == 'rent') {
		_('duration').style.display = 'block';
		_('allowed').style.display = 'block';
	} else if (this.value == 'sale') {
		_('duration').style.display = 'none';
		_('allowed').style.display = 'none';
	}
});
jQuery('document').ready(function() {
	var purpose = document.getElementById('purpose');
	if (purpose.value == 'rent') {
		document.getElementById('duration').style.display = 'block';
		document.getElementById('allowed').style.display = 'block';
	}
});

_('all-ads').addEventListener('mouseon', allAds);
function allAds() {
	_('all-ads').classList.add('active');
}
function y(k) {
	return document.querySelector(k);
}

function getState(selected) {
	if (typeof selected === undefined) {
		var selected = '';
	}
	var states = document.getElementById('state').value;
	jQuery.ajax({
		url: 'getregions',
		type: 'POST',
		data: { states: states, selected: selected },
		success: function(data) {
			jQuery('#region').html(data);
		},
		error: function() {
			alert('Invalid request to regions');
		}
	});
}
jQuery('select[name ="states"]').change(function() {
	getState();
});

jQuery().ready(function() {
	$('select[name="states"]').change(function() {
		getState("<?= $viewResult['region_id']; ?>");
	});
});

function getModel(selectedValue) {
	if (typeof selectedValue === undefined) {
		var selectedValue = '';
	}
	var make = document.getElementById('make').value;
	jQuery.ajax({
		url: 'getmodel',
		type: 'POST',
		data: { make: make, selectedValue: selectedValue },
		success: function(data) {
			jQuery('#model').html(data);
		},
		error: function() {
			alert('Invalid request to Model');
		}
	});
}
jQuery('select[name ="make"]').change(function() {
	getModel();
});

// jQuery().ready(function() {
// 	$('select[name="make"]').change(function() {
// 		getState("<?= $viewResult['region_id']; ?>");
// 	});
// });

function y(x) {
	return document.querySelector(x);
}
var elementItems = y('#cat');
elementItems.addEventListener(
	'change',
	function() {
		cat1 = y('#category1');
		cat2 = y('#category2');
		cat3 = y('#category3');
		cat4 = y('#category4');
		catInfo = y('#cat-info');
		purpose_div = y('#purpose-div');
		catInfo_display = y('#cat-info-display');
		if (this.value == 1) {
			cat1.style.display = 'grid';
			cat3.style.display = 'none';
			cat4.style.display = 'none';
			cat2.style.display = 'none';
			purpose_div.style.display = 'block';
			catInfo_display.style.display = 'block';
			catInfo.innerHTML = 'Residential Appartments';
		} else if (this.value == 2) {
			cat1.style.display = 'none';
			cat3.style.display = 'none';
			cat4.style.display = 'none';
			cat2.style.display = 'grid';
			catInfo_display.style.display = 'block';
			document.getElementById('purpose-div').style.display = 'none';
			y('#duration').style.display = 'none';

			catInfo.innerHTML = 'Cars';
		} else if (this.value == 3) {
			cat1.style.display = 'none';
			cat3.style.display = 'grid';
			cat4.style.display = 'none';
			cat2.style.display = 'none';
			purpose_div.style.display = 'block';
			catInfo_display.style.display = 'block';
			catInfo.innerHTML = 'Lands';
		} else if (this.value == 4) {
			cat1.style.display = 'none';
			cat3.style.display = 'none';
			cat4.style.display = 'grid';
			cat2.style.display = 'none';
			purpose_div.style.display = 'block';
			catInfo_display.style.display = 'block';
			catInfo.innerHTML = 'commercial Property';
		} else if (this.value == '') {
			cat1.style.display = 'none';
			cat3.style.display = 'none';
			cat4.style.display = 'none';
			cat2.style.display = 'none';
			purpose_div.style.display = 'none';
			catInfo_display.style.display = 'none';
			y('#duration').style.display = 'none';
		}
	}
	// false
);

jQuery().ready(function() {
	var cat = jQuery('#cat');
	if (cat.val() == 1) {
		document.getElementById('category1').style.display = 'grid';
		document.getElementById('purpose-div').style.display = 'block';
	}
	if (cat.val() == 2) {
		document.getElementById('category2').style.display = 'grid';
		document.getElementById('purpose-div').style.display = 'none';
		y('#duration').style.display = 'none';
	}
	if (cat.val() == 3) {
		document.getElementById('category3').style.display = 'grid';
		document.getElementById('purpose-div').style.display = 'block';
	}
	if (cat.val() == 4) {
		document.getElementById('category4').style.display = 'grid';
		document.getElementById('purpose-div').style.display = 'block';
	}
});

$(document).ready(function() {
	$('#ad-btn').click(function(event) {
		var cat = jQuery('#cat');
		var cat_error = jQuery('#cat-error');
		var roomTypeError = jQuery('#room-type-error');
		var roomType = jQuery('#rooms_type');
		var bedRooms = jQuery('#rooms');
		var bedError = jQuery('#bed-error');
		var bathroom = jQuery('#bathrooms');
		var bathError = jQuery('#bath-error');
		var furnishing = jQuery('#furnishing');
		var furnishError = jQuery('#furnish-error');
		var purpose = jQuery('#purpose');
		var purposeError = jQuery('#purpose-error');
		var duration = jQuery('#duration-value');
		var rentDurationError = jQuery('#duration-error');
		var make = jQuery('#make');
		var makeError = jQuery('#make-error');
		var model = jQuery('#model');
		var modelError = jQuery('#model-error');
		var makeYear = jQuery('#make-year');
		var makeYearError = jQuery('#make-year-error');
		var transmit = jQuery('#transmit');
		var transmitError = jQuery('#transmission-error');
		var mileage = jQuery('#mileage');
		var mileageError = jQuery('#mileage-error');
		var bodyColor = jQuery('#body-color');
		var bodyColorError = jQuery('#color-error');
		var status = jQuery('#status');
		var status_error = jQuery('#status-error');
		var image = jQuery('#image');
		var imageError = jQuery('#image-error');
		var title = jQuery('#title');
		var titleError = jQuery('#title-error');
		var description = jQuery('#description');
		var descriptionError = jQuery('#description-error');
		var price = jQuery('#price');
		var priceError = jQuery('#price-error');
		var measurement = jQuery('#measurement');
		var measurementError = jQuery('#measurement-error');
		var landType = jQuery('#land-type');
		var landTypeError = jQuery('#land-type-error');
		var landDocumentType = jQuery('#land-document');
		var landDocumentTypeError = jQuery('#document-error');
		var stateLocationC = jQuery('#state');
		var state_error = jQuery('#state_error');
		var street = jQuery('#street');
		var street_error = jQuery('#street_error');
		var regionLocation = jQuery('#region');
		var region_error = jQuery('#region_error');
		var phone = jQuery('#phone');
		var phone_error = jQuery('#phone_error');
		if (stateLocationC.val() == '') {
			state_error.text('Please select an option');
			event.preventDefault();
			stateLocationC.focus();
		} else {
			state_error.text('');
		}
		if (regionLocation.val() == '') {
			region_error.text('Please select an option');
			event.preventDefault();
			regionLocation.focus();
		} else {
			region_error.text('');
		}
		if (street.val() == '') {
			street_error.text('Please specify the closet street address');
			event.preventDefault();
			street.focus();
		} else {
			street_error.text('');
		}
		if (phone.val() == '') {
			phone_error.text('Please select an option');
			event.preventDefault();
			phone.focus();
		} else {
			phone_error.text('');
		}

		if (image.val() == '') {
			imageError.text('Image input can not be empty. Provide at least three files');
			event.preventDefault();
			image.focus();
		} else {
			imageError.text('');
		}
		if (price.val() == '') {
			priceError.text('Please specify how much you are selling');
			event.preventDefault();
			price.focus();
		} else {
			priceError.text('');
		}
		if (description.val().length < 15) {
			descriptionError.text('Please  provide at least 15 character');
			event.preventDefault();
			description.focus();
		} else {
			descriptionError.text('');
		}
		if (title.val().length < 7 || title.val().length > 70) {
			titleError.text('please supply between 7 and 70 characters');
			event.preventDefault();
			title.focus();
		} else {
			titleError.text('');
		}

		if (
			(cat.val() == 1 && purpose.val() == '') ||
			(cat.val() == 3 && purpose.val() == '') ||
			(cat.val() == 4 && purpose.val() == '')
		) {
			purposeError.text('Please select an option');
			event.preventDefault();
			purpose.focus();

			if (purpose.val() == 'rent' && duration.val() == '') {
				rentDurationError.text('Please choose a duration for the rent');
				event.preventDefault();
				duration.focus();
			} else {
				rentDurationError.text('');
			}
		} else {
			purposeError.text('');
		}

		if (cat.val() == '') {
			cat_error.text('Please select an option');
			event.preventDefault();
			cat.focus();
		} else {
			cat_error.text('');
		}
		if (cat.val() == 1) {
			if (cat.val() == 1 && furnishing.val() == '') {
				furnishError.text('Please select an option');
				event.preventDefault();
				furnishing.focus();
			} else {
				furnishError.text('');
			}

			if (cat.val() == 1 && bedRooms.val() == '') {
				bedError.text('Please select an option');
				event.preventDefault();
				bedRooms.focus();
			} else {
				bedError.text('');
			}
			if (cat.val() == 1 && bathroom.val() == '') {
				bathError.text('Please select an option');
				event.preventDefault();
				bathroom.focus();
			} else {
				bathError.text('');
			}
			if (cat.val() == 1 && roomType.val() == '') {
				roomTypeError.text('Please select an option');
				event.preventDefault();
				roomType.focus();
			} else {
				roomTypeError.text('');
			}
			status_error.text('');
			bodyColorError.text('');
			mileageError.text('');
			modelError.text('');
			makeError.text('');
			transmitError.text('');
			makeYearError.text('');
		}
		if (cat.val() == 2) {
			if (cat.val() == 2 && status.val() == '') {
				status_error.text('Please select an option');
				event.preventDefault();
				status.focus();
			} else {
				status_error.text('');
			}
			if (cat.val() == 2 && bodyColor.val() == '') {
				bodyColorError.text('Please select an option');
				event.preventDefault();
				bodyColor.focus();
			} else {
				bodyColorError.text('');
			}
			if (cat.val() == 2 && mileage.val() == '') {
				mileageError.text('Please specify the mileage of your vehicle');
				event.preventDefault();
				mileage.focus();
			} else {
				mileageError.text('');
			}
			if (cat.val() == 2 && transmit.val() == '') {
				transmitError.text('transmision error');
				event.preventDefault();
				transmit.focus();
			} else {
				transmitError.text('');
			}
			if (cat.val() == 2 && makeYear.val() == '') {
				makeYearError.text('Please selectan option');
				event.preventDefault();
				makeYear.focus();
			} else {
				makeYearError.text('');
			}
			if (cat.val() == 2 && model.val() == '') {
				modelError.text('Please select an option');
				event.preventDefault();
				model.focus();
			} else {
				modelError.text('');
			}
			if (cat.val() == 2 && make.val() == '') {
				makeError.text('please select an option');
				event.preventDefault();
				make.focus();
			} else {
				makeError.text('');
			}
			bathError.text('');
			bedError.text('');
			roomTypeError.text('');
			furnishError.text('');
			purposeError.text('');
		}
		if (cat.val() == 3) {
			if (measurement.val() == '') {
				measurementError.text('Please specify the land measuremennt');
				event.preventDefault();
				measurement.focus();
			} else {
				measurementError.text('');
			}
			if (landType.val() == '') {
				landTypeError.text('Please select an option');
				event.preventDefault();
				landType.focus();
			} else {
				landTypeError.text('');
			}
			if (landDocumentType.val() == '') {
				landDocumentTypeError.text('Please select and option');
				event.preventDefault();
				landDocumentType.focus();
			} else {
				landDocumentTypeError.text('');
			}
		}
	});
});
