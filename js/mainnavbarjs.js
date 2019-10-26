$('document').ready(function() {
	$('.hideChild').hide();
	$('.showChild').mouseenter(function() {
		$('.hideChild').show();
	});

	$('.showChild').mouseleave(function() {
		$('.hideChild').hide();
	});
});

// main nav
document.getElementById('navbardisplacer').addEventListener('click', closeMainNav);

function closeMainNav() {
	document.querySelector('.navbartoggler').style.display = 'none';
	document.querySelector('#navbardisplacer').style.display = 'none';
	document.querySelector('#hidetoggler').style.display = 'flex';
}

document.getElementById('hidetoggler').addEventListener('click', openMainNav);

function openMainNav() {
	document.querySelector('.navbartoggler').style.display = 'flex';
	document.querySelector('#navbardisplacer').style.display = 'flex';
	document.querySelector('#hidetoggler').style.display = 'none';
}
