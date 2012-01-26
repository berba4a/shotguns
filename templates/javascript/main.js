//Взема марките пистолети за даден вид пистолет
function getPistolMarks(id, add_empty) {
	if ((typeof(id) == 'undefined') || (id === false)) {
		id = '';
	} else {
		id = '\\[' + id + '\\]';
	}
	
	var type_id = $('#type_id' + id).val();
	
	$.ajax({
		type: "GET",
		url: 'http://localhost/shotguns/pistol/marks/?type_id=' + type_id,
		dataType: "json",
		success: function (data) {
			$('#mark_id' + id).find('option').remove();
			if ((typeof(add_empty) != 'undefined') && (add_empty)) {
				$('#mark_id' + id).prepend("<option value='' selected='selected'></option>");
			}
			for(i in data) {
				$('#mark_id' + id)
					.append($('<option>', { value : data[i].id })
					.text(data[i].mark));
			}
			
			//Взимаме и съответните калибри
			getPistolModels(id);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на марките!!!");
		}
	
	});
}

//Взема моделите пистолети за даден вид пистолет
function getPistolModels(id, add_empty) {
	if ((typeof(id) == 'undefined') || (id === false)) {
		id = '';
	} else {
		id = '\\[' + id + '\\]';
	}
	var mark_id = $('#mark_id' + id).val();
	
	$.ajax({
		type: "GET",
		url: 'http://localhost/shotguns/pistol/models/?mark_id=' + mark_id,
		dataType: "json",
		success: function (data) {
			$('#model_id' + id).find('option').remove();
			if ((typeof(add_empty) != 'undefined') && (add_empty)) {
				$('#model_id' + id).prepend("<option value='' selected='selected'></option>");
			}
			for(i in data) {
				$('#model_id' + id)
					.append($('<option>', { value : data[i].id })
					.text(data[i].model));
			}
			
			//Взимаме и съответните калибри
			getPistolCalibers();
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на моделите!!!");
		}
	
	});
}

//Взема калибрите за дадена марка пистолет
function getPistolCalibers(id, add_empty) {
	if ((typeof(id) == 'undefined') || (id === false)) {
		id = '';
	} else {
		id = '\\[' + id + '\\]';
	}
	var model_id = $('#model_id' + id).val();
	
	$.ajax({
		type: "GET",
		url: 'http://localhost/shotguns/pistol/calibers/?model_id=' + model_id,
		dataType: "json",
		success: function (data) {
			$('#caliber_id' + id).find('option').remove();
			if ((typeof(add_empty) != 'undefined') && (add_empty)) {
				$('#caliber_id' + id).prepend("<option value='' selected='selected'></option>");
			}
			for(i in data) {
				$('#caliber_id' + id)
					.append($('<option>', { value : data[i].id })
					.text(data[i].mark));
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на калибрите!!!");
		}
	
	});
}