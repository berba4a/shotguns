//Взема марките пистолети за даден вид пистолет
function getPistolMarks(id, add_empty) {
	var tmp_id;
	if ((typeof(id) == 'undefined') || (id === false)) {
		id = false;
		tmp_id = '';
	} else {
		tmp_id = '\\[' + id + '\\]';
	}
	var type_id = $('#type_id' + tmp_id).val();
	
	$.ajax({
		type: "GET",
		url: WWW + 'pistol/marks/?type_id=' + type_id,
		dataType: "json",
		success: function (data) {
			$('#mark_id' + tmp_id).find('option').remove();
			if ((typeof(add_empty) != 'undefined') && (add_empty)) {
				$('#mark_id' + tmp_id).prepend("<option value='' selected='selected'></option>");
			}
			for(i in data) {
				$('#mark_id' + tmp_id)
					.append($('<option>', { value : data[i].id })
					.text(data[i].mark));
			}
			
			if (id) {
				if ((typeof(default_mark_id[id]) !== 'undefined') && (default_mark_id[id])) {
					$('#mark_id' + tmp_id).val(default_mark_id[id]);
					default_mark_id[id] = false;
				}
			} else {
				if ((typeof(default_mark_id) !== 'undefined') && (default_mark_id)) {
					$('#mark_id' + tmp_id).val(default_mark_id);
					default_mark_id = false;
				}
			}
			
			//Взимаме и съответните калибри
			getPistolModels(id, add_empty);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на марките!!!");
		}
	
	});
}

//Взема моделите пистолети за даден вид пистолет
function getPistolModels(id, add_empty) {
	var tmp_id;
	if ((typeof(id) == 'undefined') || (id === false)) {
		id = false;
		tmp_id = '';
	} else {
		tmp_id = '\\[' + id + '\\]';
	}
	var mark_id = $('#mark_id' + tmp_id).val();
	
	$.ajax({
		type: "GET",
		url: WWW + 'pistol/models/?mark_id=' + mark_id,
		dataType: "json",
		success: function (data) {
			$('#model_id' + tmp_id).find('option').remove();
			if ((typeof(add_empty) != 'undefined') && (add_empty)) {
				$('#model_id' + tmp_id).prepend("<option value='' selected='selected'></option>");
			}
			for(i in data) {
				$('#model_id' + tmp_id)
					.append($('<option>', { value : data[i].id })
					.text(data[i].model));
			}

			if (id) {
				if ((typeof(default_model_id[id]) !== 'undefined') && (default_model_id[id])) {
					$('#model_id' + tmp_id).val(default_model_id[id]);
					default_model_id[id] = false;
				}
			} else {
				if ((typeof(default_model_id) !== 'undefined') && (default_model_id)) {
					$('#model_id' + tmp_id).val(default_model_id);
					default_model_id = false;
				}
			}
			
			//Взимаме и съответните калибри
			getPistolCalibers(id, add_empty);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на моделите!!!");
		}
	
	});
}

//Взема калибрите за дадена марка пистолет
function getPistolCalibers(id, add_empty) {
	var tmp_id;
	if ((typeof(id) == 'undefined') || (id === false)) {
		id = false;
		tmp_id = '';
	} else {
		tmp_id = '\\[' + id + '\\]';
	}
	var model_id = $('#model_id' + tmp_id).val();
	
	$.ajax({
		type: "GET",
		url: WWW + 'pistol/calibers/?model_id=' + model_id,
		dataType: "json",
		success: function (data) {
			$('#caliber_id' + tmp_id).find('option').remove();
			if ((typeof(add_empty) != 'undefined') && (add_empty)) {
				$('#caliber_id' + tmp_id).prepend("<option value='' selected='selected'></option>");
			}
			for(i in data) {
				$('#caliber_id' + tmp_id)
					.append($('<option>', { value : data[i].id })
					.text(data[i].mark));
			}
			
			if (id) {
				if ((typeof(default_caliber_id[id]) !== 'undefined') && (default_caliber_id[id])) {
					$('#caliber_id' + tmp_id).val(default_caliber_id[id]);
					default_caliber_id[id] = false;
				}
			} else {
				if ((typeof(default_caliber_id) !== 'undefined') && (default_caliber_id)) {
					$('#caliber_id' + tmp_id).val(default_caliber_id);
					default_caliber_id = false;
				}
			}
		},
		error: function (jqXHR, textStatus, errorThrown) {
			alert("Има грешка при зареждането на калибрите!!!");
		}
	
	});
}