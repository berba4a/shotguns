<div class="mainMenuBand"><b>Регистрация на дилър</b></div>
	<div class="mainField">
		<div class="addLogo" ><img src="images/dealers.gif" width="80" /></div>
		<div class="addingWelcomeText">Добре дошли в страницата за <b>РЕГИСТРАЦИЯ НА ДИЛЪР</b> Регистрацията и публикуването на обяви от Дилъри е безплатно.  Потребителите виждат пълната информация за контакт въведена в обявата и от тях не се изисква заплащане .Отбелязаните със <span class="redStar">*</span> полета са задължителни.В случай, че ви е необходима помощ или допълнителна информация не се колебайте да се свържете с нас:</div> 

	<div style="clear:both;">&nbsp;</div>

 	<form id="addingForm" name="addingForm" action="" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainAddingFieldset" name="mainAddingFieldset">
  			<legend class="addingLegend">Вашите данни:</legend>

  				<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    					<legend  class="addingLegend">1.Данни на потребителя:</legend>
                        <div style="width:450px; text-align:right;">
                        <span class="redStar">*</span>Потребителско име:
    						<input class="aField" type="text" id="username" name="username" /><br />
						<span class="redStar">*</span>Парола:
                        	<input class="aField" type="password" id="password" name="password" /><br />
                            <span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;font-size:10px;">(паролата не трябва да е по-малка от 6 символа
и не трябва да е еднаква с потребителското име)</span><br />
						<span class="redStar">*</span>Повтори паролата:
                        	<input class="aField" type="password" id="passwordRe" name="passwordRe" />
						</div>
						
				</fieldset>
                
                
<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">2.Данни за контакт:</legend>
    <div style="width:450px; text-align:right;">
    <span style="color:red;">Тази информация ще се вижда във Вашите обяви.</span><br /><br />
	<span class="redStar">*</span>Име на дилъра:<input class="aField" type="text" id="name"  name="name"/><br />
    <span class="redStar">*</span>Населено място:
    <select class="aField" id="location" name="location">
    <option>Каспичан</option>
    <option>Криво поле</option>
    <option>Стърчипишка</option>
    <option>Каснаково</option>
    <option>Сърница</option>
    </select>
    <br />
    <span class="redStar">*</span>Адрес:<textarea class="aField" id="address" name="address" cols="30" rows="2"></textarea><br />
	Стационарен телефон:<input class="aField" type="text" id="phone" name="phone" /><br />
    <div id="mobile"><span class="redStar">*</span>Мобилен телефон 1:<input class="aField" type="text" id="mobilen[]" name="mobilen[]" /><br />


    <script>
				var mobile_counter = 1;
				function addMobileField() {
					mobile_counter++;
					div = document.createElement("div");
					text = document.createTextNode("Мобилен телефон "+mobile_counter+":")
					mobile = document.createElement("input");
					mobile.type = "text";
					mobile.id = "mobilen[]";
					mobile.name = "mobilen[]";
					mobile.className = "aField";
					div.appendChild(text);
					div.appendChild(mobile);					
					document.getElementById("mobile").appendChild(div);
					document.getElementById("mobile").appendChild(div);
					
					}
			</script>
            </div>
            <input style="margin-top:5px;" type="button" onclick="javascript: addMobileField();" value="Добави поле за мобилен телефон" /><br />
    <span class="redStar">*</span>e-mail:<input class="aField" type="text" id="email"  name="email"/><br />
   	Skype:<input class="aField" type="text" id="skype"  name="skype"/><br />
    уебсайт:<input class="aField" type="web" id="price"  name="web" value="http://"/>
    <span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;font-size:10px;"><br />
(Пример: http://mysyte.com )</span>
    
	</div>
	</fieldset>
    
    <fieldset class="addingFields" id="subdomainFieldSet" name="subdomainFieldSet">
    <legend  class="addingLegend">3.Лична страница във MySite.com:</legend>
    <span class="redStar">*</span>Име на вашата страница:&nbsp;<input class="aField" type="text" id="name"  name="name"/>.MySite.com<br />
    <span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;font-size:10px;">(Моля изпишете желаното име само с малки латниски букви без интервали!)</span>
    </fieldset>
    
<fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">3.Добавяне на лого на фирмата:</legend>
	
	Прикачане на изображение:<br />
			<div id="up_images" name="up_images"><br /><br />
			
			<div><input type="file" id="images[]" name="images[]"></div><br />
					<span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-weight:normal;font-size:10px;">(Това изображение ще бъде показвано във Вашите обяви и на Вашата лична страница ,като лого на фирмата.)</span>
			</div>
		<br />
	</fieldset>
    
    <fieldset class="addingFields" id="dataFieldSet" name="dataFieldSet">
    <legend  class="addingLegend">4.Административна информация:</legend>
    <div style="width:450px; text-align:right;">
    <span style="color:red;">Информацията в тази секция не е публична. Използва се за връзка между администратори на MySite.com и Вас.</span><br /><br />
	<span class="redStar">*</span>Име на фирмата:<input class="aField" type="text" id="firmName"  name="firmName"/><br />
    <span class="redStar">*</span>Лице за контакт:<input class="aField" type="text" id="adminName"  name="adminName"/><br />
    <div id="mobileAdmin"><span class="redStar">*</span>Телефон за контакти 1:<input class="aField" type="text" id="mobilenAdmin[]" name="mobilenAdmin[]" /><br />


    <script>
				var mobileAd_counter = 1;
				function addMobileFieldAdmin() {
					mobileAd_counter++;
					div = document.createElement("div");
					text = document.createTextNode("Телефон за контакти "+mobileAd_counter+":")
					mobile = document.createElement("input");
					mobile.type = "text";
					mobile.id = "mobilenAdmin[]";
					mobile.name = "mobilenAdmin[]";
					mobile.className = "aField";
					div.appendChild(text);
					div.appendChild(mobile);					
					document.getElementById("mobileAdmin").appendChild(div);
					document.getElementById("mobileAdmin").appendChild(div);
					
					}
			</script>
            </div>
            <input style="margin-top:5px;" type="button" onclick="javascript: addMobileFieldAdmin();" value="Добави поле за телефон" /><br />
    <span class="redStar">*</span>Административен e-mail:<input class="aField" type="text" id="email"  name="email"/><br />
   
    </div>
    
	</fieldset>
    
<div class="addFinalText"><img style="border:0px;" src="images/warning.gif" width="30" height="30" /> Ако попълнените от Вас полета са коректни и желаното от  Вас лого на фирмата е прикачено ,за да видите как ще изглежда Вашата обява моля натиснете бутона <span style="font-weight:bold;">Регистрация</span> ,а ако полетата са некоректни за да изчистите формата натиснете бутона <span style="font-weight:bold;">Изчистване на полетата</span>.</div>
<div style="text-align:center;margin-bottom:20px; "><input style="width:150px; height:40px; font-weight:bold;"  type="submit" id="submitForm" name="submitForm" value="РЕГИСТРАЦИЯ"/>
<input style="margin-left:200px; height:40px;" type="reset" id="clearForm" name="clearForm" value="Изчистване на полетата"/></div>

</fieldset>

</form>
</div>