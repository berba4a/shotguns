function removePrefix(prefix, data) {
	var key = '';
	var return_data = {};
	var tmp_key = '';
	
	for (key in data) {
		tmp_key = key.replace(prefix, '').toUpperCase();
		return_data[tmp_key] = data[key];
//	    console.info(key + ': ' + sender_data[key]);
//	    console.info(tmp_key + ': ' + sender_data[key]);
	}
	
	return return_data;
}

function checkDropdown() {
	var empty = [];	
	
	$('select').each(function() {
    	if(!$(this).val() && $(this).is(":visible") && !$(this).is(':disabled')) {  	
    		empty.push($(this).attr('id'));
	    	$(this).addClass('error');
    	}else {
	    	$(this).removeClass('error');
    	}
	});
	
	if(empty[0]) {
		alert("Моля попълнете задължителните полета!");
		$('#'+empty[0]).focus();
	} else return true;
}

function isTime(obj) {
	console.info(obj);
	var value = data.val();
	
	//var format = /^(\d{2}):(\d{2})$/;
	var format = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
	
	if (!value.match(format) && value) {
		data.addClass('error');
		alert("Некоректен формат (HH:MM)!");
	} else {
		data.removeClass('error');
	}
	
}

function isNumber(data) {
	var value = data.val();
	
	if ((isNaN(data.val())) || (Math.round(data.val()) != data.val())) {
		data.addClass('error');
		alert("Очаква се цяло число (X)!");
	} else {
		data.removeClass('error');
	}
}

function isFloat(data) {
	var value = data.val();
	
	if (isNaN(data.val())) {
		data.addClass('error');
		alert("Очаква се число (XX.YY)!");
	} else {
		data.removeClass('error');
	}
}

function isDate(data) {
	var value = data.val();
	var format = /^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[0-2])\.[0-9]{4}$/;
	
	if (!value.match(format) && value) {
		data.addClass('error');
		alert("Очаква се дата (DD.MM.YYYY)!");
	} else {
		data.removeClass('error');
	}
}

function checkMaxLength(data, length) {
	if (data.val().length > length) {
		data.addClass('error');
		alert("Максималната дължина на полето е " + length + " !");
	} else {
		data.removeClass('error');
	}
}

function checkMinLength(data, length) {
	console.info(data);
	if (data.val().length < length) {
		data.addClass('error');
		alert("Минималната дължина на полето е " + length + " !");
	} else {
		data.removeClass('error');
	}
}

function checkRequiredFields(alert) {
	var error = false;
	var i = 0;
	var id = '';
	
	for(i = 0; i < $('[required="true"]').length; i++) {
		id = $('[required="true"]')[i].id;
		
		if ($('#' + id).val() == '') {
			if ($('#' + id).hasClass('required_ready')) {
				$('#' + id).removeClass('required_ready');
			}
			if (!$('#' + id).hasClass('required')) {
				$('#' + id).addClass('required');
			}
			error = true;
		} else {
			if ($('#' + id).hasClass('required')) {
				$('#' + id).removeClass('required');
			}
			if (!$('#' + id).hasClass('required_ready')) {
				$('#' + id).addClass('required_ready');
			}
		}
	}
	
	if (alert) {
		alert('Полетата в червено са задължителни!!!');
	}
}