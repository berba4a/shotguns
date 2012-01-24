	<div class="mainField">
	<div class="addLogo" ><img src="{$smarty.const.WWW}templates/images/pistol.gif" /></div>
		<div class="addingWelcomeText">Добре дошли в заглавната страница на раздел <b>ПИСТОЛЕТИ .</b></div>
				<div style="clear:both;">&nbsp;</div>
                
		<div class="beginPageLeftField">
			
            <div class="searchHeaders" style="width:auto;">Бързо търсене в ПИСТОЛЕТИ</div> 
             <form id="basicSearchForm" name="basicSearchForm" action="" method="POST" enctype="multipart/form-data">
             
          <div class="simpleSearchField">
             
            <div class="beginPageRows">
                <div style="float:left;">Раздел: <br />
               
                <select id="mainCategory" name="mainCategory">
                <option>Пистолети</option>
                <option>Пушки</option>
                <option>Патрони</option>
                <option>Оптики</option>
                <option>Екипировка</option>
				<option>Аксесоари</option>
                <option>Ловни кучета</option>
				<option>Офроуд автомобили</option>

                </select>
                </div>
            
            	<div align="right"><img src="{$smarty.const.WWW}templates/images/pistol.gif" width="40" /></div>
            
            <div style="clear:both">&nbsp;</div>
            </div>
            
            <div class="beginPageRows">
            <div style="float:left;">Категория: <br />
               
                <select id="category" name="category">
                <option>Револвери</option>
                <option>Автоматични</option>
                <option>Плуавтоматични</option>
                <option>Пневматични</option>
                <option>Газови</option>
                </select>
                </div>
                
                <div align="right">Марка: <br />
               
                <select id="marka" name="marka">
                <option>Макаров</option>
                <option>Колт</option>
                <option>Смит § Уесън</option>
                <option>Берета</option>
                <option>ТТ</option>
                </select>
                </div>
            
            
			<div style="clear:both">&nbsp;</div>
            </div>
            
            <div class="beginPageRows">
            <div style="float:left;">Модел: <br />
               
                <select id="calibre" name="calibre">
                <option>Модел 1</option>
                <option>Модел 2</option>
                <option>Модел 3</option>
                <option>Модел 4</option>
                <option>Модел 5</option>
                </select>
                </div>
                
                <div align="right">Калибър: <br />
               
               
                <select id="calibre" name="calibre">
                <option>Калибър 1</option>
                <option>Калибър 2</option>
                <option>Калибър 3</option>
                <option>Калибър 4</option>
                <option>Калибър 5</option>
                </select>
                </div>
            
            
			<div style="clear:both">&nbsp;</div>
            </div>
            
            
            <div class="beginPageRows">
			 <div align="left" style="float:left;">Цена до: <br />
               
                <input type="text" size="10" id="maxPrice" name="maxPrice"/>
                <select id="currency" name="currency">
                <option>Лева</option>
                <option>EUR</option>
                </select>
                </div>
				
            <div align="right">Състояние: <br /></div>
                <div align="right">Нов<input type="checkbox" name="condition[]" value="value[]" /></div>
				<div align="right" >Употребяван<input type="checkbox" name="condition[]" value="value[]" /></div>
            	
			<div style="clear:both">&nbsp;</div>
            
            </div>
            
            <div class="beginPageRows">
            <div style="float:left;"><a href="{$smarty.const.WWW}pistol/search" style="color:#685300; text-decoration:underline;">Подробно търсене>></a></div>
            	<div align="right" ><input style="width:100px; height:30px; font-family:Verdana, Geneva, sans-serif; font-weight:bold;" type="submit" name="submitBtn" id="submitBtn" value="ТЪРСИ" /></div>
			<div style="clear:both">&nbsp;</div>
            
            </div>
            
            </div>
            
            </form>
            <div class="banner3" style="margin-left:0px;">       
		<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="300" height="250" align="middle">
			<param name="movie" value="swf/flashvortex_sqr.swf">
			<param name="quality" value="high">
			<embed src="swf/flashvortex_sqr.swf" width="300" height="250" align="middle" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>
		  </object>
 				</div>
        <!--LeftField end -->    
		</div>
        
        
        
        <!--RightField begin -->
        <div class="beginPageRightField">
        	 <div class="searchHeaders" style="width:auto;">Последни обяви в категория ПИСТОЛЕТИ</div>
            
             <!--Начало на голямата обява -->
             <div class="beginPageRows" style="border-bottom:1px solid #c5ac49; padding-bottom:5px; height:112px;">
                 
                 <div class="beginPageBigPicture">
                 <a href="#"><img id="bgnPageBigPic" name="bgnPageBigPic" src="{$smarty.const.WWW}templates/images/testLogo.jpg" width="150" border="0" /></a>
                 </div>
             
                 <div class="beginPageBigAdText" align="right" id="bgnPageBigAdTaxt" name="bgnPageBigAdTaxt">
                  <a href="#">
                    Пистолет Макаров<br />
					Модел 1<br />
                    <font color="red"><b> 150 Лева </b></font><br />
                    Каспичан<br />
                    <br />
                    12.01.2012
                    </a>
                  </div>
                     <div style="clear:both">&nbsp;</div>
             </div>
             <!--Край на голямата обява -->
             
             {foreach $pistols as $pistol}
             	<!--Начало на малка обява -->
	             <div class="beginPageRows" style="border-bottom:1px solid #c5ac49; padding-bottom:5px;">
	                <a href="#">
	                    <div align="left" style="float:left;" class="beginPageSmallAdText">
	                   <!--Лого на дистрибутора ако обявата е от дистрибутор ,ако не логото на сайта -->
	                    <img src="{$smarty.const.WWW}templates/images/testLogo.jpg" height="10" border="0"/>
	                    Пистолет , {$pistol->mark->mark} Модел 2, {$pistol->city->city}               
	                    </div>
	                    
	                    <div class="beginPageSmallAdText" align="right">
	                    <b>{$pistol->price} {$pistol->currency->currency}</b>
	                    </div>
	                </a>
	              </div>  
	              <!--Край на малката обява -->
             {/foreach}
            
            <div class="searchHeaders" style="width:auto;margin-top:20px;">Статистика</div>
            <div align="center"><img src="{$smarty.const.WWW}templates/images/warning.gif"  height="100"/><br />
В момента статистиката е достъпна само за администратора на сайта!
             </div>
             </div>
       
         <!--RightField End -->
             
         
        <div style="clear:both">&nbsp;</div>
         
		<!--<div style="clear:both;margin-top:-10px;">&nbsp;</div>-->
	</div>