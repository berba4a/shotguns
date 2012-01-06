//Взема марките пистолети за даден вид пистолет
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
			
			//Взимаме и съответните калибри
			getPistolCalibers();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на марките!!!");
		}
	
	});
}

//Взема калибрите за дадена марка пистолет
function getPistolCalibers() {
	var mark_id = $('#mark_id').val();
	
	$.ajax({
		type: "GET",
		url: 'http://shotguns/pistol/calibers/?mark_id=' + mark_id,
		dataType: "json",
		success: function (data) {
			$('#caliber_id').find('option').remove();
			for(i in data) {
				$('#caliber_id')
					.append($('<option>', { value : data[i].id })
					.text(data[i].mark));
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на калибрите!!!");
		}
	
	});
}