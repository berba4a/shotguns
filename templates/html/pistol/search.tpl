<div class="mainMenuBand">Подробно търсене на обява в категория <b>ПИСТОЛЕТИ</b></div>

	<div class="mainField">
	<div class="addLogo" ><img src="{$smarty.const.WWW}templates/images/pistol.gif" /></div>
		<div class="addingWelcomeText">Добре дошли в раздела за <b>ПОДРОБНО ТЪРСЕНЕ</b> в раздел <b>ПИСТОЛЕТИ</b> .Aко Вашето търсене не е свързано със този раздел моля изберете исканата от вас категория от менюто <a href="#">избор на категория</a> или се върнете в <a href="#">началото</a> на сайта.</div> 
	<div style="clear:both;">&nbsp;</div>

	
	<form id="searchForm" name="searchForm" action="{$smarty.const.WWW}pistol/results" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainSearchFieldset" name="mainSearchFieldset">
  			<legend class="addingLegend">Вашето търсене:</legend>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Състояние:</div>
            <ul>
				
				<li><input type="checkbox" name="is_old[]" value="0" {if in_array(0, $smarty.session.tmp_pistol_search.is_old)}checked{/if}/>Нов</li>
                <li><input type="checkbox" name="is_old[]" value="1" {if in_array(1, $smarty.session.tmp_pistol_search.is_old)}checked{/if} />Употребяван</li>

            </ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Категория:</div>
			<ul>
				{foreach $types as $type}
					<li><input type="checkbox" name="type_id[]" value="{$type->id}" {if in_array($type->id, $smarty.session.tmp_pistol_search.type_id)}checked{/if} />{$type->type}</li>
				{/foreach}
			</ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Марка:</div>

            <ul>
				{foreach $marks as $mark}
					<li><input type="checkbox" name="mark_id[]" value="{$mark->id}" {if in_array($mark->id, $smarty.session.tmp_pistol_search.mark_id)}checked{/if} />{$mark->mark}</li>
				{/foreach}
			</ul>

            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Калибър:</div>
            <ul>
				{foreach $calibers as $caliber}
					<li><input type="checkbox" name="caliber_id[]" value="{$caliber->id}" {if in_array($caliber->id, $smarty.session.tmp_pistol_search.caliber_id)}checked{/if} />{$caliber->caliber}</li>
				{/foreach}
			</ul>
            </div>
            <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;">Местоположение:</div>
            <ul>
				{foreach $cities as $city}
					<li><input type="checkbox" name="city_id[]" value="{$city->id}" {if in_array($city->id, $smarty.session.tmp_pistol_search.city_id)}checked{/if} />{$city->city}</li>
				{/foreach}
			</ul>
           </div>
           <div  class="searchMenu"> <div style="font-weight:bold;background-color:#c5ac49;padding-left:5px;width:150px;">Цена:</div>
            <ul style="height:auto;">
				<li style="margin-top:10px;margin-right:5px;margin-left:-35px;">От <input type="text" id="start_price" name="start_price" size="10" value="{$smarty.session.tmp_pistol_search.start_price}"/></li>

                <li style="margin-top:10px;margin-right:5px;margin-left:-35px;">До <input type="text" id="end_price" name="end_price" size="10" value="{$smarty.session.tmp_pistol_search.end_price}"/></li>
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
				<li><input type="radio" name="has_image" value="1" />Със снимки</li>
                <li><input type="radio" name="has_image" value="0" />Без снимки</li>

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
            <li style="margin-top:5px;align:right;">
            	<select id="order_by" name="order_by">
		            <option value="created">Дата</option>
		            <option value="price">Цена</option>
		            <option value="mark_id">Марка</option>
		            <option value="caliber_id">Калибър</option>
	            </select>
			</li>
            </ul>
            </div>
            </div>
             
            <div style="clear:both">&nbsp;</div>
            
<div align="center" style="margin-top:15px;"><input type="reset" id="clearForm" style="height:50px;font-family:Verdana, Arial, Helvetica, sans-serif;" name="clearForm" value="Изчистване на полетата"/>

<input  type="submit" id="submitForm" name="submitForm" style="margin-left:200px;height:50px;width:200px;font-weight:bold;font-family:Verdana, Arial, Helvetica, sans-serif;"  value="Т ъ р с е н е" /></div>
             <div class="addFinalText"><img style="border:0px;" src="{$smarty.const.WWW}templates/images/warning.gif" width="30" height="30" />Всички полета отбелязани със <input type="checkbox" checked="checked" /> участват в търсенето.Ако върнатите резултати са прекалено много моля размаркирайте ненужните полета!</div>
	</fieldset>
    
</form>
	</div>