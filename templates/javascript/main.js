function getPistolMarks() {
	var type_id = $('#type_id').val();
	
	$.ajax({
		type: "GET",
		url: 'http://shotguns/pistol/marks/?type_id=' + type_id,
		dataType: "json",
		success: function (data) {
			$('#mark_id').find('option').remove();
			for(i in data) {
				$('#mark_id')
					.append($('<option>', { value : data[i].id })
					.text(data[i].mark));
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на марките!!!");
		}
	
	});
	
	
}