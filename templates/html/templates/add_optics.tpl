<div class="mainMenuBand">Публикуване на обява в катеория <b>ОПТИКИ</b></div>
	<div class="mainField">
		<div class="addLogo" ><img src="images/optika.gif" /></div>
		<div class="addingWelcomeText">Добре дошли в страницата за <b>ПУБЛИКУВАНЕ</b> на вашата обява в раздел <b>ОПТИКИ</b> .Aко вашата обява не е свързана със този раздел моля върнете се на предходната страница за <a href="#">избор на категория</a> или в <a href="#">началото</a> на сайта.Отбелязаните със <span class="redStar">*</span> полета са задължителни.</div> 

	<div style="clear:both;">&nbsp;</div>

 	<form id="addingForm" name="addingForm" action="" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainAddingFieldset" name="mainAddingFieldset">
  			<legend class="addingLegend">Вашата обява:</legend>

  				<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    					<legend  class="addingLegend">1.Данни на обявата:</legend>
    

						<ul class="addingMenu">
	<li><span class="redStar">*</span>Категория:<br /><select class="aField" id="category" name="category">
					  <option>Оптичен мерник</option>
					  <option>Бинокъл</option>
					  <option>Уред за нощно виждане</option>
					  <option>Лазерен прицел</option>
					   <option>Уред за термално виждане</option>
					</select>
</li>

    <li><span class="redStar">*</span>Марка:<br /><select class="aField" id="marka" name="marka">
  <option>Carl Zeiss</option>
				  <option>Nikon</option>
				  <option>Walther</option>
				  <option>Swarowski Optic</option>
				   <option>Lichter</option>
					</select>
   </li>

<li><span class="redStar">*</span>Модел:<br /><select class="aField" id="marka" name="marka">
  <option>CZ 1.8-8x50 HMT</option>
  <option>Модел 2</option>
  <option>Модел 3</option>
  <option>Модел 4</option>
   <option>Модел 5</option>
	</select>
   </li>


    <li><span class="redStar">*</span>Размер:<br /><select class="aField" id="size" name="size">
  <option>1-8x</option>
				  <option>2.4-16x</option>
				  <option>2.5-16x</option>
				  <option>2.5-15x</option>
				   <option>2.5x</option>
					</select>
	</li>

	<li><div style="float:left;"><span class="redStar">*</span>Цена:<br /><input class="aField" type="text" size="10" id="price"  name="price"/></div>
	<div style="float:left;margin-left:3px;"><span class="redStar">*</span>Валута:<br /><select class="aField" id="valuta" name="valuta">
  <option>Лева</option>
  <option>EUR</option>
	</select></div><div style="clear:both">&nbsp;</div>
	</li>
	<li><span class="redStar">*</span>Местоположение:<br /><select class="aField" id="location" name="location">
  <option>Област София</option>
  <option>Област Пловдив</option>
  <option>Област Стара Загора</option>
  <option>Област Хасково</option>
   <option>Област Варна</option>
</select>
</li>
	<li><span class="redStar">*</span>Употреба:<br /><select class="aField" id="owned" name="owned">
  <option>Ново</option>
  <option>Старо</option>
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
		</li><br />

		<li>Оставащи снимки за прикачане:<span style="color:red;">10</span></li>
		<li><span class="redStar">*</span>Максимален брой снимки:10.</li>
	</ul>
	</fieldset>
<div class="addFinalText"><img style="border:0px;" src="images/warning.gif" width="30" height="30" /> Ако попълнените от Вас полета са коректни и всички желани снимки от Вас са прикачени ,за да видите как ще изглежда Вашата обява моля натиснете бутона <span style="font-weight:bold;">Преглед на обявата</span> ,а ако полетата са некоректни за да изчистите формата натиснете бутона <span style="font-weight:bold;">Изчистване на полетата</span>.</div>
<div style="text-align:center;margin-bottom:20px;"><input  type="submit" id="submitForm" name="submitForm" value="Преглед на обявата"/>
<input style="margin-left:200px;" type="reset" id="clearForm" name="clearForm" value="Изчистване на полетата"/></div>

</fieldset>

</form>
</div>