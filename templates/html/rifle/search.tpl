<script type="text/javascript">
<!--
		var default_mark_id = new Array();
		default_mark_id[0] = '{$smarty.session.tmp_rifle_search.mark_id.0}';
		default_mark_id[1] = '{$smarty.session.tmp_rifle_search.mark_id.1}';
		default_mark_id[2] = '{$smarty.session.tmp_rifle_search.mark_id.2}';
		
		var default_model_id = new Array();
		default_model_id[0] = '{$smarty.session.tmp_rifle_search.model_id.0}';
		default_model_id[1] = '{$smarty.session.tmp_rifle_search.model_id.1}';
		default_model_id[2] = '{$smarty.session.tmp_rifle_search.model_id.2}';
		
		var default_caliber_id = new Array();
		default_caliber_id[0] = '{$smarty.session.tmp_rifle_search.caliber_id.0}';
		default_caliber_id[1] = '{$smarty.session.tmp_rifle_search.caliber_id.1}';
		default_caliber_id[2] = '{$smarty.session.tmp_rifle_search.caliber_id.2}';
		
	$(document).ready(function() {	
		getRifleMarks(0, true);
		getRifleMarks(1, true);
		getRifleMarks(2, true);
	});
//-->
</script>
<div class="mainMenuBand">Подробно търсене на обява в категория <b>ПУШКИ</b></div>

	<div class="mainField">
	<div class="addLogo" ><img src="{$smarty.const.WWW}templates/images/rifles_big.gif" width="80" /></div>
		<div class="addingWelcomeText">Добре дошли в раздела за <b>ПОДРОБНО ТЪРСЕНЕ</b> в раздел <b>ПУШКИ</b> .Aко Вашето търсене не е свързано със този раздел моля изберете исканата от вас категория от менюто <a href="#">избор на категория</a> или се върнете в <a href="#">началото</a> на сайта.</div> 
	<div style="clear:both;">&nbsp;</div>

	
	<form id="searchForm" name="searchForm" action="{$smarty.const.WWW}rifle/results" method="POST" enctype="multipart/form-data">
  		<fieldset style="margin-left:10px;margin-right:10px;margin-bottom:10px;" id="mainSearchFieldset" name="mainSearchFieldset">
  			<legend class="addingLegend">Вашето търсене:</legend>
           <div  class="searchMenu"> <div class="searchHeaders">Категория:</div>
			<ul>
			
			
		<!--		{foreach $types as $type}
					<li><input type="checkbox" name="type_id[]" value="{$type->id}" {if in_array($type->id, $smarty.session.tmp_rifle_search.type_id)}checked{/if} />{$type->type}</li>
				{/foreach}
				-->
				<li>1. 
					<select id="type_id[0]" name="type_id[0]" onchange="javascript: getRifleMarks(0, true);">
						<option></option>
						{foreach $types as $type}
							<option value="{$type->id}" {if $smarty.session.tmp_rifle_search.type_id.0 == $type->id}selected{/if}>{$type->type}</option>
						{/foreach}
					</select>
				</li>
				<li>2. 
					<select id="type_id[1]" name="type_id[1]" onchange="javascript: getRifleMarks(1, true);">
						<option></option>
						{foreach $types as $type}
							<option value="{$type->id}" {if $smarty.session.tmp_rifle_search.type_id.1 == $type->id}selected{/if}>{$type->type}</option>
						{/foreach}
					</select>
				</li>
				<li>3. 
					<select id="type_id[2]" name="type_id[2]" onchange="javascript: getRifleMarks(2, true);">
						<option></option>
						{foreach $types as $type}
							<option value="{$type->id}" {if $smarty.session.tmp_rifle_search.type_id.2 == $type->id}selected{/if}>{$type->type}</option>
						{/foreach}
					</select>
				</li>
			</ul>
            </div>
			
			
			 <div  class="searchMenu"> <div class="searchHeaders">Тип:</div>
			<ul>
			
			
		<!--		{foreach $marks as $mark}
					<li><input type="checkbox" name="mark_id[]" value="{$mark->id}" {if in_array($mark->id, $smarty.session.tmp_rifle_search.mark_id)}checked{/if} />{$mark->mark}</li>
				{/foreach}
				
				-->
				<li>1.<br />
					<select id="modification_id[0]" name="modification_id[0]" onchange="javascript:">
						<option></option>
{*
						{foreach $marks as $mark}
							<option value="{$mark->id}">{$mark->mark}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>2.<br />
					<select id="modification_id[1]" name="modification_id[1]" onchange="javascript: ">
						<option></option>
{*
						{foreach $marks as $mark}
							<option value="{$mark->id}">{$mark->mark}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>3.<br />
					<select id="modification_id[2]" name="modification_id[2]" onchange="javascript:">
						<option></option>
{*
						{foreach $marks as $mark}
							<option value="{$mark->id}">{$mark->mark}</option>
						{/foreach}
*}
					</select>
				</li>
			</ul>
            </div>
			
			
			
            <div  class="searchMenu"> <div class="searchHeaders">Марка:</div>
			<ul>
			
			
		<!--		{foreach $marks as $mark}
					<li><input type="checkbox" name="mark_id[]" value="{$mark->id}" {if in_array($mark->id, $smarty.session.tmp_rifle_search.mark_id)}checked{/if} />{$mark->mark}</li>
				{/foreach}
				
				-->
				<li>1.<br />
					<select id="mark_id[0]" name="mark_id[0]" onchange="javascript: getRifleModels(0, true);">
						<option></option>
{*
						{foreach $marks as $mark}
							<option value="{$mark->id}">{$mark->mark}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>2.<br />
					<select id="mark_id[1]" name="mark_id[1]" onchange="javascript: getRifleModels(1, true);">
						<option></option>
{*
						{foreach $marks as $mark}
							<option value="{$mark->id}">{$mark->mark}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>3.<br />
					<select id="mark_id[2]" name="mark_id[2]" onchange="javascript: getRifleModels(2, true);">
						<option></option>
{*
						{foreach $marks as $mark}
							<option value="{$mark->id}">{$mark->mark}</option>
						{/foreach}
*}
					</select>
				</li>
			</ul>
            </div>
            <div  class="searchMenu"><div class="searchHeaders">Модел:</div>

            <ul>
				<li>1.<br />
					<select id="model_id[0]" name="model_id[0]" onchange="javascript: getRifleCalibers(0, true);">
						<option></option>
{*
						{foreach $models as $model}
							<option values="{$model->id}">{$model->model}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>2.<br />
					<select id="model_id[1]" name="model_id[1]" onchange="javascript: getRifleCalibers(1, true);">
						<option></option>
{*
						{foreach $models as $model}
							<option values="{$model->id}">{$model->model}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>3.<br />
					<select id="model_id[2]" name="model_id[2]" onchange="javascript: getRifleCalibers(2, true);">
						<option></option>
{*
						{foreach $models as $model}
							<option values="{$model->id}">{$model->model}</option>
						{/foreach}
*}
					</select>
				</li>
			  </ul>
            </div>
			
            <div  class="searchMenu"><div class="searchHeaders">Калибър:</div>
            <ul>
			<!--
				{foreach $calibers as $caliber}
					<li><input type="checkbox" name="caliber_id[]" value="{$caliber->id}" {if in_array($caliber->id, $smarty.session.tmp_rifle_search.caliber_id)}checked{/if} />{$caliber->caliber}</li>
				{/foreach}
				-->
				<li>1.<br />
					<select id="caliber_id[0]" name="caliber_id[0]">
						<option></option>
{*
						{foreach $calibers as $caliber}
							<option id="{$caliber->id}">{$caliber->caliber}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>2.<br />
					<select id="caliber_id[1]" name="caliber_id[1]">
						<option></option>
{*
						{foreach $calibers as $caliber}
							<option id="{$caliber->id}">{$caliber->caliber}</option>
						{/foreach}
*}
					</select>
				</li>
				<li>3.<br />
					<select id="caliber_id[2]" name="caliber_id[2]">
						<option></option>
{*
						{foreach $calibers as $caliber}
							<option id="{$caliber->id}">{$caliber->caliber}</option>
						{/foreach}
*}
					</select>
				</li>
			</ul>
            </div>
            <div  class="searchMenu"> <div class="searchHeaders">Местоположение:</div>
            <ul>
				{foreach $cities as $city}
					<li><input type="checkbox" name="city_id[]" value="{$city->id}" {if in_array($city->id, $smarty.session.tmp_rifle_search.city_id)}checked{/if} />{$city->city}</li>
				{/foreach}
			</ul>
           </div>
           <div  class="searchMenu"> <div class="searchHeaders" style="width:150px;">Цена:</div>
            <ul style="height:auto;">
				<li style="margin-top:10px;margin-right:5px;margin-left:-35px;">От <input type="text" id="start_price" name="start_price" size="10" value="{$smarty.session.tmp_rifle_search.start_price}"/></li>

                <li style="margin-top:10px;margin-right:5px;margin-left:-35px;">До <input type="text" id="end_price" name="end_price" size="10" value="{$smarty.session.tmp_rifle_search.end_price}"/></li>
                <li style="margin-top:10px;margin-right:5px;margin-left:-35px;">
                <select class="aField" id="currency_id" name="currency_id">
                      {foreach $currencies as $currency}
                      	<option id="{$currency->id}" {if $smarty.session.tmp_rifle_search.currency_id == $currency->id}selected{/if}>{$currency->currency}</option>
                      {/foreach}
                 </select>

                 </li>
               </ul>
             </div>
			 
			  <div  class="searchMenu">
				 <div class="searchHeaders">Състояние:</div>
					 <ul  style="height:50px;margin-top:5px;">
						<li><input type="checkbox"  name="is_old[]" value="0" {if in_array(0, $smarty.session.tmp_rifle_search.is_old)}checked{/if}/>Нови</li>
						<li><input type="checkbox"  name="is_old[]" value="1" {if in_array(1, $smarty.session.tmp_rifle_search.is_old)}checked{/if} />Употребявани</li>
					</ul>
					</div>
          
				<div  class="searchMenu" style="margin-top:50px; height:auto;">
					<div class="searchHeaders">Снимки:</div>
							<ul style="height:auto; margin-top:5px;">
								<li><input type="radio" id="has_image" name="has_image" value="1" {if $smarty.session.tmp_rifle_search.has_image}checked{/if} />Със снимки</li>
								<li><input type="radio" id="has_image" name="has_image" value="0" {if !$smarty.session.tmp_rifle_search.has_image}checked{/if}/>Всички</li>
							</ul>
				</div>
			
			
						
			
           <div  class="searchMenu" style="margin-top:50px; height:auto;">
				<div class="searchHeaders">Давност:</div>
					<ul class="searchMenu" style="height:30px; margin:5px;">
						<li>
					<select id="date" name="date">
					<option>От днес</option>
					<option>От 3 дни</option>
					<option>От 7 дни</option>
					<option>От 14 Дни</option>
					<option>Всички</option>
					</select>
					</li>
					</ul>
			</div>
            
           <div  class="searchMenu" style="margin-top:50px; height:auto;">
				<div class="searchHeaders" style="">Сортиране по:</div>
					<ul style="height:auto;margin-top:5px;align:right;">
						<li>
            	<select id="order_by" name="order_by">
		            <option value="created">Дата</option>
		            <option value="price">Цена</option>
		            <option value="mark_id">Марка</option>
		            <option value="caliber_id">Калибър</option>
	            </select>
			</li>
            </ul>
            </div>
           
            
            <div style="clear:both">&nbsp;</div>
            
<div align="center" style="margin-top:60px;"><input type="reset" id="clearForm" style="height:50px;font-family:Verdana, Arial, Helvetica, sans-serif;" name="clearForm" value="Изчистване на полетата"/>

<input  type="submit" id="submitForm" name="submitForm" style="margin-left:200px;height:50px;width:200px;font-weight:bold;font-family:Verdana, Arial, Helvetica, sans-serif;"  value="Т ъ р с е н е" /></div>
             <div class="addFinalText"><img style="border:0px;" src="{$smarty.const.WWW}templates/images/warning.gif" width="30" height="30" />Всички полета отбелязани със <input type="checkbox" checked="checked" /> участват в търсенето.Ако върнатите резултати са прекалено много моля размаркирайте ненужните полета!</div>
	</fieldset>
    
</form>
	</div>