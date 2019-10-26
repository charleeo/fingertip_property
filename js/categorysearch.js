$(document).ready(function() {
	load_data();
	function load_data(query) {
		$.ajax({
			url: 'searchcategories.php',
			method: 'POST',
			data: { query: query },
			success: function(data) {
				$('#results').html(data);
			}
		});
	}
	$('#search').keyup(function() {
		var search = $(this).val();
		if (search != '') {
			load_data(search);
		} else {
			document.getElementById('results').innerHTML = 'data not found';
			load_data();
		}
	});
});
