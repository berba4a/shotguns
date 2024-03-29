	<div class="mainMenuBand">Резултати от търсене в категория <b>ОПТИКИ</b></div>
	<div class="mainField">
	<div class="addLogo" ><img src="{$smarty.const.WWW}templates/images/optics_big.gif" width="80" /></div>
		<div class="addingWelcomeText">Резултати от вашето търсене в раздел <b>ОПТИКИ</b> ,   Категория:<b>{$type_id_text}</b> ,Състояние: <b>{$is_old_text}</b> , Марка:<b>{$mark_id_text}</b>  Модел:<b>{$model_id_text}</b>,Калибър:<b>{$size_id_text}</b> ,Местоположение:<b>{$city_id_text}</b> ,Цена:<b>{$start_price_text} {$end_price_text}</b> ,Снимки:<b>Със снимки</b> ,Давност:<b>От Днес</b> ,Сортирани по:<b>Цена</b> . Ако това не са изискванията на вашето търсене можете да направите:<br />
<div style="text-align:center;font-size:15px;font-weight:bold;margin-top:10px;"><a href="{$smarty.const.WWW}optic/search" >Ново търсене</a> или <a  href="{$smarty.const.WWW}optic/search?edit_search=1">Корекция на търсенето</a></div></div>
		<div style="clear:both;">&nbsp;</div>
		
		<div class="searchResultHeader">{$start_result}-{$end_result} от общо {$all_result} резултата</div>
		<div class="searchPagesField">
		<div class="searchPages">страница {$page} от {$max_page}</div>
		<div class="searchPagesR">
			<ul>
				{if $page > 1}<li>Назад</li>{/if}
				{section start=$start_button loop=$end_button+1 name=button_counter}
					<li {if $page == $smarty.section.button_counter.index}class="selectedPage"{/if}>{$smarty.section.button_counter.index}</li>
				{/section}
				{if $page < $max_page}<li>Напред</li>{/if}
			</ul>
		</div>
		</div>
		{foreach $optics as $optic}
			<!-- Начало на обявата -->
	       <div class="adRow">
	    	<div class="adRowPic"><a href="{$smarty.const.WWW}optic/preview?optic_id={$optic->id}"><img src="{$smarty.const.WWW}{$optic->images.0->image}" width="150" border="0" /></a></div> 
		   <div class="adRowTextField">
		   	<div class="adHeadLine">{$optic->type->type} {$optic->mark->mark} {$optic->model->model} {$optic->size->size} - {if $optic->is_old} Използван {else} Нов {/if} &nbsp; <span class="adPrice">{$optic->price} {$optic->currency->currency}</span></div>
		   <div class="adText">
		   {$optic->type->type}, {$optic->mark->mark}, {$optic->model->model}, {$optic->size->size}, {if $optic->is_old} Използван {else} Нов {/if}<br />
			Местоположение: {$optic->city->city}<br />
			{$optic->description}
			</div>
			 </div>
		   <!--Лого на дилъра ако обявата е от дилър -->
		   <div class="adRowLogo"><a href="#"><img src="{$smarty.const.WWW}templates/images/testLogo.jpg" width="50" border="0"/></a></div>
		   <div style="clear:both">&nbsp;</div>
			<div class="adRowFooter">
			<div align="left" style="float:left;"><a style="text-decoration:underline;color:#685300;" href="{$smarty.const.WWW}optic/preview?optic_id={$optic->id}">Снимки и детайли</a></div>
			<div align="right" style="padding-right:35px;">Дата на публикуване: {$optic->created}</div>
			</div>
		   </div>
			<!-- Край на обявата -->
		{/foreach}


		<div class="searchResultHeader">{$start_result}-{$end_result} от общо {$all_result} резултата</div>
		<div class="searchPagesField" style="border-top:2px solid #685300;">
		<div class="searchPages">страница {$page} от {$max_page}</div>
		<div class="searchPagesR">
			<ul>
				{if $page > 1}<li>Назад</li>{/if}
				{section start=$start_button loop=$end_button+1 name=button_counter}
					<li {if $page == $smarty.section.button_counter.index}class="selectedPage"{/if}>{$smarty.section.button_counter.index}</li>
				{/section}
				{if $page < $max_page}<li>Напред</li>{/if}
			</ul>
		</div>
		</div>
        
		<div style="clear:both;margin-top:-10px;">&nbsp;</div>
	</div>