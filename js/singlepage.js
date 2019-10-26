// Page Loader

$(document).ready(function() {
	jQuery(window).on('load', function() {
		jQuery('#loader-div').fadeOut('slow');
	});
});

// image gallery
const currentImage = document.querySelector('#currentImage');
const images = document.querySelectorAll('.product-thumbnails');

images.forEach((element) => element.addEventListener('click', thumnailClick));
function thumnailClick(e) {
	currentImage.classList.remove('active');
	currentImage.addEventListener('transitionend', () => {
		currentImage.src = this.querySelector('img').src;
		currentImage.classList.add('active');
	});
	images.forEach((element) => element.classList.remove('selected'));
	this.classList.add('selected');
}
// Validate sellers contact form
$(document).ready(function() {
	$('#submit').click(function(e) {
		var email = $('#email').val();
		var sender_name = $('#sender').val();
		var message = $('#body-message').val();
		resultMessage = $('#result_message');
		if (sender_name == '' || email == '' || message == '') {
			resultMessage.html('Fill all fields');
			return false;
		}
	});
});

document.getElementById('show-contact').addEventListener('click', function() {
	document.getElementById('sellers-phone').style.display = 'block';
	document.querySelector('.disclaimer').style.display = 'flex';
	document.querySelector('#seller-phone-hidden').style.display = 'inline';
	document.getElementById('show-contact').style.display = 'none';
});
document.getElementById('dismiss-warning').addEventListener('click', function() {
	document.querySelector('#warning-div').style.display = 'none';
});

// Contact Moddal
document.querySelector('#button').addEventListener('click', function() {
	document.querySelector('#contactSection').style.display = 'flex';
	document.querySelector('#button').style.display = 'none';
});
// Close the contact section
document.querySelector('#closecontact').addEventListener('click', function() {
	document.querySelector('#contactSection').style.display = 'none';
	document.querySelector('#button').style.display = 'block';
});

//disclaimer button Modal
document.querySelector('.close-disclaimer').addEventListener('click', function() {
	document.querySelector('.disclaimer').style.display = 'none';
});
// Images Modal

document.querySelector('.all-image').addEventListener('click', function() {
	document.querySelector('.imagegallery-modal').style.display = 'flex';
});
document.querySelector('.second-close-button').addEventListener('click', function() {
	document.querySelector('.imagegallery-modal').style.display = 'none';
});

// Image slider

let sliderImages = document.querySelectorAll('.product-modal-display'),
	arrowLeftft = document.querySelector('#arrow-left'),
	arrowRight = document.querySelector('#arrow-right'),
	current = 0;
const conut = sliderImages.length;
document.querySelector('#all-images').innerHTML = conut;
let slideText = document.querySelectorAll('.slidernumber');
for (let i = 0; i < slideText.length; i++) {
	indexText = slideText[i];
	indexText.innerHTML = sliderImages.length;
}

function reset() {
	for (let i = 0; i < sliderImages.length; i++) {
		sliderImages[i].style.display = 'none';
	}
}

// Initialise slider
function startSlide() {
	reset();
	sliderImages[0].style.display = 'grid';
	for (let i = 0; i < slideText.length; i++) {
		indexText = slideText[i];
		indexText.innerHTML = 'Slide' + ' ' + [ i + 1 ] + ' of ' + ' ' + slideText.length;
	}
}

// show previous image
function leftSlide() {
	reset();
	sliderImages[current - 1].style.display = 'grid';
	current--;
}
// Add event to left arrow
arrowLeftft.addEventListener('click', function() {
	if (current === 0) {
		current = sliderImages.length;
	}
	leftSlide();
});

// Show next image
function rightSlide() {
	reset();
	sliderImages[current + 1].style.display = 'grid';
	current++;
}
arrowRight.addEventListener('click', function() {
	if (current === sliderImages.length - 1) {
		current = -1;
	}
	rightSlide();
});

startSlide();
// Page loader
