<div class="mainMenuBand">Подробно търсене на обява в категория <b>ПИСТОЛЕТИ</b></div>

	<div class="mainField">
	<div class="addLogo" ><img src="images/pistol.gif" /></div>
		<div class="addingWelcomeText">Добре дошли в раздела за <b>ПОДРОБНО ТЪРСЕНЕ</b> в раздел <b>ПИСТОЛЕТИ</b> .Aко Вашето търсене не е свързано със този раздел моля изберете исканата от вас категория от менюто <a href="#">избор на категория</a> или се върнете в <a href="#">началото</a> на сайта.</div> 
	<div style="clear:both;">&nbsp;</div>

	
	<form id="searchForm" name="searchForm" action="" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainSearchFieldset" name="mainSearchFieldset">
  			<legend class="addingLegend">Вашето търсене:</legend>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Състояние:</div>
            <ul>
				
				<li><input type="checkbox" name="is_old[]" value="0" />Нов</li>
                <li><input type="checkbox" name="is_old[]" value="1" />Употребяван</li>

            </ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Категория:</div>
			<ul>
				{foreach $categories as $category}
					<li><input type="checkbox" name="category_id[]" value="{category_id}" />{$category->category}</li>
				{/foreach}
			</ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Марка:</div>

            <ul>
				{foreach $marks as $mark}
					<li><input type="checkbox" name="marka_id" value="{$mark->id}" />{$mark->mark}</li>
				{/foreach}
			</ul>

            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Калибър:</div>
            <ul>
				{foreach $calibers as $caliber}
					<li><input type="checkbox" name="calibre[]" value="{$caliber->id}" />{$caliber->caliber}</li>
				{/foreach}
			</ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Местоположение:</div>
            <ul>
				{foreach $cities as $city}
					<li><input type="checkbox" name="location[]" value="{$city->id}" />{$city->city}</li>
				{/foreach}
			</ul>
           </div>
           <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;width:150px;">Цена:</div>
            <ul style="height:auto;">
				<li style="margin-top:10px;margin-right:5px;margin-left:-35px;">От <input type="text" id="start_price" name="start_price" size="10"/></li>

                <li style="margin-top:10px;margin-right:5px;margin-left:-35px;">До <input type="text" id="end_price" name="end_price" size="10"/></li>
                <li style="margin-top:10px;margin-right:5px;margin-left:-35px;">
                <select class="aField" id="currency_id" name="currency_id">
                      <option>Лева</option>
                      <option>EUR</option>
                      <option>USD</option>
                 </select>

                 </li>
                        
             </ul>
             </div>
             <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Снимки:</div>
             <ul>
				
				<li><input type="checkbox" name="has_image" value="0" />Със снимки</li>
                <li><input type="checkbox" name="pictures[]" value="1" />Без снимки</li>

            </ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:3px;width:150px;">Давност:</div>
            <ul class="searchMenu" style="height:auto;">
            <li style="margin:5px;">
            <select id="date" name="date">
            <option>От днес</option>

            <option>От 3 дни</option>
            <option>От 7 дни</option>
            <option>От 14 Дни</option>
            <option>Всички</option>
            </select>
			</li>
            </ul>

            <div style="clear:both">&nbsp;</div>
            <div  class="searchMenu" style="margin-left:0px;"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:3px;width:150px;">Сортиране по:</div>
            <ul style="height:auto;">
            <li style="margin-top:5px;align:right;"><select id="sortBy" name="sortBy">
            <option>Дата</option>
            <option>Цена</option>
            <option>Марка</option>

            <option>Калибър</option>
            </select>
			</li>
            </ul>
            </div>
            </div>
             
            <div style="clear:both">&nbsp;</div>
            
<div align="center" style="margin-top:15px;"><input type="reset" id="clearForm" style="height:50px;font-family:Verdana, Arial, Helvetica, sans-serif;" name="clearForm" value="Изчистване на полетата"/>

<input  type="submit" id="submitForm" name="submitForm" style="margin-left:200px;height:50px;width:200px;font-weight:bold;font-family:Verdana, Arial, Helvetica, sans-serif;"  value="Т ъ р с е н е" /></div>
             <div class="addFinalText"><img style="border:0px;" src="images/warning.gif" width="30" height="30" />Всички полета отбелязани със <input type="checkbox" checked="checked" /> участват в търсенето.Ако върнатите резултати са прекалено много моля размаркирайте ненужните полета!</div>
	</fieldset>
    
</form>
	</div>