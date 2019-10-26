// Nav bar top
function _(x) {
	return document.getElementById(x);
}

_('navbar-icon').addEventListener('click', openNavItem);

function openNavItem() {
	_('leftside').style.display = 'flex';
	_('navbar-icon').style.display = 'none';
	_('navbar-close').style.display = 'block';
}

_('navbar-close').addEventListener('click', closeNavItem);

function closeNavItem() {
	_('leftside').style.display = 'none';
	_('navbar-icon').style.display = 'block';
	_('navbar-close').style.display = 'none';
}
