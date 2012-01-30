	<script type="text/javascript" src="{$smarty.const.WWW}templates/javascript/prototype.js"></script>
	<script type="text/javascript" src="{$smarty.const.WWW}templates/javascript/scriptaculous.js?load=effects,builder"></script>
	<script type="text/javascript" src="{$smarty.const.WWW}templates/javascript/lightbox.js"></script>
<div class="mainMenuBand">Публикуване на обява в катеория <b>ОПТИКИ - ПРЕГЛЕД НА ОБЯВАТА</b></div>

	<div class="mainField">
	<div class="firstTitle">{$optic->type->type} {$optic->mark->mark} {$optic->model->model} {$optic->size->size} - {if $optic->is_old} Използван {else} Нов {/if}</div>
	<div class="mainAdField">
		<div class="gallery">
			<ul class="gallery">
				<li><a href="{$smarty.const.WWW}{$optic->images.0->image}" rel="lightbox[something]" title="my caption"><img class="adBigPic" id="bigPic" name="bigPic" src="{$smarty.const.WWW}{$optic->images.0->image}" /></a></li>
				{foreach $optic->images as $image}
					<li><a href="{$smarty.const.WWW}{$image->image}" rel="lightbox[something]" title="my caption"><img class="adSmallPic" onclick="document.bigPic.src=this.src;" src="{$smarty.const.WWW}{$image->image}" /></a></li>
				{/foreach}
			</ul>

		</div>
		<div class="adText"><span class="secondTitle">{$optic->type->type} {$optic->mark->mark} {$optic->model->model} {$optic->size->size} - {if $optic->is_old} Използван {else} Нов {/if}</span></div><br />
<br />
<br />
<div  class="descrHeaders">
		<ul>
			<li>Цена:<span style="color:red;font-size:16px;font-weight:bold;">{$optic->price} {$optic->currency->currency}</span></li>
			<li>Категория:<span>Пистолети</span></li>

			<li>Марка:<span>{$optic->mark->mark}</span></li>
			<li>Модел:<span>{$optic->model->model}</span></li>
			<li>Размер:<span>{$optic->size->size}</span></li>
			<li>Употреба:<span>{if $optic->is_old} Използван {else} Нов {/if}</span></li>
			<li>Дата на публикуване:<span>{$optic->created}</span></li>
			<li><hr style="margin-right:20px;" />Подробно описание:<hr style="margin-right:20px;" /><span>{$optic->description}</span></li>

			</ul>
			</div>
		<div style="clear:both;">&nbsp;</div>
<div class="contactField">
	<hr />
	<span class="secondTitle">За контакти</span>
	<hr />
	<div class="contacts">
	<div style="margin-left:-20px;"  class="descrHeaders">

		<ul>
			<li>Име за контакт:<span>{$optic->user->real_name}</span></li>
			<li>Телефон за контакт:<span>{$optic->user->phone}</span></li>
			<li>e-mail:<span>{$optic->user->email}</span></li>
			<li>Местоположение:<span>{$optic->city->city}</span></li>

			</ul>
			
		<div class="banner3">
		
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="300" height="250" align="middle">
			<param name="movie" value="swf/flashvortex_sqr.swf">
			<param name="quality" value="high">
			<embed src="swf/flashvortex_sqr.swf" width="300" height="250" align="middle" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
		  </object>
 				</div>
			</div>	
		</div>

	<div  class="contactForm">
	<span class="firstTitle" style="border-bottom:hidden;">Форма за директен контакт</span>
	<div class="addingFields">
	<form id="feedBack" name="feedBack" action="" method="POST" enctype="multipart/form-data">
	Име:<br />
<input type="text" /><br /><br />

Телефон:<br />
<input type="text" /><br /><br />


e-mail:<br />
<input type="text" /><br /><br />


Вашето запитване:<br />
<TEXTAREA  NAME="Description" COLS=30 ROWS=8></TEXTAREA><br />
<input  type="submit" id="submitForm" name="submitForm" value="Изпрати"/>
<input style="margin-left:20px;" type="reset" id="clearForm" name="clearForm" value="Изчистване на полетата"/></form>
				</div>
			</div>

		<div style="clear:both;">&nbsp;</div>
	</div>	
</div>

{if !empty($save_preview)}
	<div style="text-align:center;margin-bottom:20px;">
		<input  type="button" id="btn_edit" name="btn_edit" value="Публикувай обявата" onclick="javascript: document.location = '{$smarty.const.WWW}optic/ur_activate'"/>
		<input style="margin-left:200px;" type="button" id="btn_edit" name="btn_edit" value="Редактирай обявата" onclick="javascript: window.location = '{$smarty.const.WWW}optic/ur_add/?edit=1';"/>
	</div>
{/if}
</div>