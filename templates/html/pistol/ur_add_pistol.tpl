<div class="mainMenuBand">Публикуване на обява в катеория <b>ПИСТОЛЕТИ</b></div>
	<div class="mainField">
		<div class="addLogo" ><img src="{$smarty.const.WWW}templates/images/pistol.gif" /></div>
		<div class="addingWelcomeText">Добре дошли в раздела за добавяне на вашата обява в раздел <b>пистолети</b> .Aко вашата обява не е свързана със този раздел моля върнете се на предходната страница за <a href="#">избор на категория</a> или в <a href="#">началото</a> на сайта.Отбелязаните със <span class="redStar">*</span> полета са задължителни.</div> 

	<div style="clear:both;">&nbsp;</div>

	<hr style="margin-left:20px;margin-right:20px;margin-top:-10px;" />

 	<form id="addingForm" name="addingForm" action="" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainAddingFieldset" name="mainAddingFieldset">
  			<legend class="addingLegend">Вашата обява:</legend>

  				<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    					<legend  class="addingLegend">1.Данни на обявата:</legend>
						<ul class="addingMenu">
	<li><span class="redStar">*</span>Категория:<br />
	<select class="aField" id="type_id" name="type_id" onchange="javascript: getPistolMarks();">
		{foreach $pistol_types as $pistol_type}
			<option value="{$pistol_type->id}">{$pistol_type->type}</option>
		{/foreach}
	</select>
</li>

    <li><span class="redStar">*</span>Марка:<br /><select class="aField" id="marka" name="marka">
  <option>Байкал</option>
  <option>Glock</option>
  <option>Colt</option>
  <option>TT</option>
   <option>Берета</option>
	</select>
   </li>

    <li><span class="redStar">*</span>Калибър:<br /><select class="aField" id="calibre" name="calibre">
  <option>Калнбър1</option>
  <option>Калнбър2</option>
  <option>Калнбър3</option>
  <option>Калнбър4</option>
   <option>Калнбър5</option>
	</select>
	</li>

	<li><span class="redStar">*</span>Цена:<br /><input class="aField" type="text" id="price"  name="price"/></li>

	<li><span class="redStar">*</span>Местоположение:<br />
	<select class="aField" id="city_id" name="city_id">
		{foreach $cities as $city}
			<option value="{$city->id}">{$city->city}</option>
		{/foreach}
	</select>
</li>
	<li><span class="redStar">*</span>Употреба:<br />
	<select class="aField" id="is_old" name="is_old">
		<option value="0">Ново</option>
		<option value="1">Старо</option>
	</select>
	</li>
<li><span>Описание на продукта:</span><br />
<TEXTAREA class="aField" NAME="Description" COLS=30 ROWS=8></TEXTAREA><br />
<span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;font-size:10px;">/Подробно описание на вашата обява/</span></li>
</ul>
	</fieldset>
<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">2.Данни за контакт:</legend>
	<ul class="addingMenu">
    	<li>Име:<br /><input class="aField" type="text" id="name"  name="name"/></li>
	<li><span class="redStar">*</span>Телефон:<br /><input class="aField" type="text" id="phone"  name="phone"/></li>
	<li>e-mail:<br /><input class="aField" type="text" id="email"  name="email"/></li>	
	<li>уебсайт:<br /><input class="aField" type="web" id="price"  name="web"/></li>	
</ul>
	</fieldset>

<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">3.Добавяне на снимки:</legend>
	
	<ul class="addingMenu">
		<li style="margin-top:0px;">Прикачане на снимки:<br />
			<div id="up_images" name="up_images"><input type="button" value="Добави поле за снимка" onclick="javascript: addFileField();"><br /><br />
			<script>
				function addFileField() {
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
		</li>
	</ul>
	</fieldset>
<div class="addFinalText"><img style="border:0px;" src="images/warning.gif" width="30" height="30" /> Ако попълнените от Вас полета са коректни и всички желани снимки от Вас са прикачени ,за да видите как ще изглежда Вашата обява моля натиснете бутона <span style="font-weight:bold;">Преглед на обявата</span> ,а ако полетата са некоректни за да изчистите формата натиснете бутона <span style="font-weight:bold;">Изчистване на полетата</span>.</div>
<div style="text-align:center;margin-bottom:20px;"><input  type="submit" id="submitForm" name="submitForm" value="Преглед на обявата"/>
<input style="margin-left:200px;" type="reset" id="clearForm" name="clearForm" value="Изчистване на полетата"/></div>

</fieldset>

</form>
</div>