<script>
	var default_mark_id = '{$mark_id}';
	var default_model_id = '{$model_id}';
	var default_caliber_id = '{$caliber_id}';
	$(document).ready(function() {
		getRifleMarks();
	});
</script>

<div class="mainMenuBand">Публикуване на обява в катеория <b>ПУШКИ</b></div>
	<div class="mainField">
		<div class="addLogo" ><img src="{$smarty.const.WWW}templates/images/rifles_big.gif" width="80" /></div>
		<div class="addingWelcomeText">Добре дошли в раздела за <b>ПУБЛИКУВАНЕ</b> на вашата обява в раздел <b>ПУШКИ</b> .Aко вашата обява не е свързана със този раздел моля върнете се на предходната страница за <a href="#">избор на категория</a> или в <a href="#">началото</a> на сайта.Отбелязаните със <span class="redStar">*</span> полета са задължителни.</div> 

	<div style="clear:both;">&nbsp;</div>
	
	{if !empty($site_error)}
		<span class="error_message">{$site_error}</span>
	{/if}

 	<form id="addingForm" name="addingForm" action="{$smarty.const.WWW}rifle/save_ur_rifle" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainAddingFieldset" name="mainAddingFieldset">
  			<legend class="addingLegend">Вашата обява:</legend>

  				<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    					<legend  class="addingLegend">1.Данни на обявата:</legend>
						
						<ul class="addingMenu">
	<li><span class="redStar">*</span>Категория:<br />
	<select class="aField" id="type_id" name="type_id" onchange="javascript: getRifleMarks();">
		{foreach $rifle_types as $rifle_type}
			<option value="{$rifle_type->id}" {if $type_id == $rifle_type->id}selected{/if}>{$rifle_type->type}</option>
		{/foreach}
	</select>
	{if !empty($type_id_error)}
		<br><span class="error_message">{$type_id_error}</span>
	{/if}
</li>

    <li><span class="redStar">*</span>Марка:<br />
    <select class="aField" id="mark_id" name="mark_id" onchange="javascript: getRifleModels();">
	</select>
	{if !empty($mark_id_error)}
		<br><span class="error_message">{$mark_id_error}</span>
	{/if}
   </li>

<li><span class="redStar">*</span>Модел:<br />
	<select class="aField" id="model_id" name="model_id" onchange="javascript: getRifleCalibers();">
	</select>
	{if !empty($model_id_error)}
		<br><span class="error_message">{$model_id_error}</span>
	{/if}
   </li>

    <li><span class="redStar">*</span>Калибър:<br />
    <select class="aField" id="caliber_id" name="caliber_id">
	</select>
	{if !empty($caliber_id_error)}
		<br><span class="error_message">{$caliber_id_error}</span>
	{/if}
	</li>

	<li ><div style="float:left;"><span class="redStar">*</span>Цена:<br />
		<input class="aField" type="text" size="10" id="price"  name="price" value="{$price}"/></div>
		{if !empty($price_error)}
			<br><span class="error_message">{$price_error}</span>
		{/if}
	
	
	<div style="float:left;margin-left:3px;"><span class="redStar">*</span>Валута:<br />
		<select class="aField" id="currency_id" name="currency_id">
			{foreach $currency as $curr}
				<option value="{$curr->id}" {if $currency_id == $curr->id}selected{/if}>{$curr->currency}</option>
			{/foreach}
		</select></div><div style="clear:both">&nbsp;</div>
	</li>
	

	<li><span class="redStar">*</span>Местоположение:<br />
	<select class="aField" id="city_id" name="city_id">
		{foreach $cities as $city}
			<option value="{$city->id}" {if $city_id == $city->id}selected{/if}>{$city->city}</option>
		{/foreach}
	</select>
	{if !empty($city_id_error)}
		<br><span class="error_message">{$city_id_error}</span>
	{/if}
</li>
	<li><span class="redStar">*</span>Употреба:<br />
	<select class="aField" id="is_old" name="is_old">
		<option value="0" {if $is_old == 0}selected{/if}>Ново</option>
		<option value="1" {if $is_old == 1}selected{/if}>Старо</option>
	</select>
	{if !empty($is_old_error)}
		<br><span class="error_message">{$is_old_error}</span>
	{/if}
	</li>
<li><span>Описание на продукта:</span><br />
<TEXTAREA class="aField" name="description" id="description" COLS=30 ROWS=8>{$description}</TEXTAREA>
	{if !empty($is_old_error)}
		<br><span class="error_message">{$is_old_error}</span>
	{/if}
	<br />
<span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;font-size:10px;">/Подробно описание на вашата обява/</span></li>
</ul>
	</fieldset>
<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">2.Данни за контакт:</legend>
	<ul class="addingMenu">
    	<li>Име:<br />
    		<input class="aField" type="text" id="real_name"  name="real_name" value="{$real_name}"/>
    		{if !empty($real_name_error)}
    			<br><span class="error_message">{$real_name_error}</span>
    		{/if}
    	</li>
		<li>
			Телефон:<br />
			<input class="aField" type="text" id="phone"  name="phone" value="{$phone}"/>
    		{if !empty($phone_error)}
    			<br><span class="error_message">{$phone_error}</span>
    		{/if}
		</li>
		<li>
			<span class="redStar">*</span>e-mail:<br />
			<input class="aField" type="text" id="email"  name="email" value="{$email}"/>
    		{if !empty($email_error)}
    			<br><span class="error_message">{$email_error}</span>
    		{/if}
		</li>	
		<li>
			уебсайт:<br />
			<input class="aField" type="web" id="website"  name="website" value="{$website}"/>
    		{if !empty($website_error)}
    			<br><span class="error_message">{$website_error}</span>
    		{/if}
		</li>	
</ul>
	</fieldset>

<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">3.Добавяне на снимки:</legend>
	
	<ul class="addingMenu">
		<li style="margin-top:0px;">Прикачане на снимки:<br />
			<div id="up_images" name="up_images"><input type="button" value="Добави поле за снимка" onclick="javascript: addFileField();"><br /><br />
			<script>
				var image_counter = 9;
				function addFileField() {
					if (image_counter > 0) {
						image_counter--;
						$('#image_counter').html(image_counter);
					} else {
						return;
					}
					div = document.createElement("div");
					file = document.createElement("input");
					file.type = "file";
					file.id = "images[]";
					file.name = "images[]";
					div.appendChild(file);
					document.getElementById("up_images").appendChild(div);
				}
			</script>
			<div><input type="file" id="images[]" name="images[]"></div></div>
		</li><br />
<li>Оставащи снимки за прикачане:<span style="color:red;" id="image_counter">10</span> от 10</li><br>
	</ul>
	</fieldset>
<div class="addFinalText"><img style="border:0px;" src="{$smarty.const.WWW}templates/images/warning.gif" width="30" height="30" /> Ако попълнените от Вас полета са коректни и всички желани снимки от Вас са прикачени ,за да видите как ще изглежда Вашата обява моля натиснете бутона <span style="font-weight:bold;">Преглед на обявата</span> ,а ако полетата са некоректни за да изчистите формата натиснете бутона <span style="font-weight:bold;">Изчистване на полетата</span>.</div>
<div style="text-align:center;margin-bottom:20px;"><input  type="submit" id="submitForm" name="submitForm" value="Преглед на обявата"/>
<input style="margin-left:200px;" type="reset" id="clearForm" name="clearForm" value="Изчистване на полетата"/></div>

</fieldset>

</form>
</div>