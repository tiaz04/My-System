
<?php

foreach ($elementi as $elem){


	?>
<h2>Traduzione Domande & Risposte<br><?=$elem->domanda?></h2>

<?php

/** DOMANDA faq */

?>
<div class="elem_trad">
<div class="col_sin_trad">
<h2>Domanda Italiano</h2>
	<?=$elem->domanda?></div>
<div class="col_des_trad"><?php  foreach ($info['lingue'] as $lang => $lang_pic) {


	if ($lang!="it"){
			

		echo "<a class=\"gotolang\" where=\"".$lang."_".$elem->lang_domanda."\" target=\"cont_$elem->lang_domanda\">$lang_pic</a> ";
	} }?>
<div class="col_des_cont" id="cont_<?=$elem->lang_domanda?>"><?php foreach ($info['lingue'] as $lang => $lang_pic) {

	if ($lang!="it"){

		foreach ($elem->domanda_traduzioni as $trad){
			if ($trad->lang==$lang){
				$contenuto_trad=$trad->messaggio;
				break;
			}
			else
			$contenuto_trad="";
		}

		?>
<div id="<?=$lang?>_<?=$elem->lang_domanda?>" class="cont_trad">
<form action="" method="post" class="carica_trad" attr="testo">
<h2><?php echo $lang_pic;?></h2>
		<? echo form_textarea_nci('Testo Modulo','contenuto_'.$elem->lang_domanda.'_'.$lang,$contenuto_trad,'class="ckeditor"'); ?>
<br>
<input type="hidden" name="lang" value="<?=$lang?>"> <input
	type="hidden" name="progressivo" value="<?=$elem->lang_domanda?>"> <input
	type="submit" value="Aggiorna Traduzione">
<div id="<?=$elem->lang_domanda?>_<?=$lang?>_ris"></div>
</form>
</div>
		<?php
	}
}?></div>
</div>
<div style="clear: both;"></div>
</div>

<?php

/** RISPOSTA faq */

?>
<div class="elem_trad">
<div class="col_sin_trad">
<h2>Testo Italiano</h2>
	<?=$elem->risposta?></div>
<div class="col_des_trad"><?php  foreach ($info['lingue'] as $lang => $lang_pic) {


	if ($lang!="it"){
			

		echo "<a class=\"gotolang\" where=\"".$lang."_".$elem->lang_risposta."\" target=\"cont_$elem->lang_risposta\">$lang_pic</a> ";
	} }?>
<div class="col_des_cont" id="cont_<?=$elem->lang_risposta?>"><?php foreach ($info['lingue'] as $lang => $lang_pic) {

	if ($lang!="it"){

		foreach ($elem->risposta_traduzioni as $trad){
			if ($trad->lang==$lang){
				$contenuto_trad=$trad->messaggio;
				break;
			}
			else
			$contenuto_trad="";
		}

		?>
<div id="<?=$lang?>_<?=$elem->lang_risposta?>" class="cont_trad">
<form action="" method="post" class="carica_trad" attr="testo">
<h2><?php echo $lang_pic;?></h2>
		<? echo form_textarea_nci('Testo Modulo','contenuto_'.$elem->lang_risposta.'_'.$lang,$contenuto_trad,'class="ckeditor"'); ?>
<br>
<input type="hidden" name="lang" value="<?=$lang?>"> <input
	type="hidden" name="progressivo" value="<?=$elem->lang_risposta?>"> <input
	type="submit" value="Aggiorna Traduzione">
<div id="<?=$elem->lang_risposta?>_<?=$lang?>_ris"></div>
</form>
</div>
		<?php
	}
}?></div>
</div>
<div style="clear: both;"></div>
</div>

<?



}

?>

<script type="text/javascript">
$('.gotolang').click(function(){
where=$(this).attr('where');
target=$(this).attr('target');

$('#'+target).scrollTo($('#'+where), 800);
	
});

$(".carica_trad").submit(function(event) {

    /* stop form from submitting normally */
    event.preventDefault(); 
        
    /* get some values from elements on the page: */
    var $form = $( this ),
        lang = $form.find( 'input[name="lang"]' ).val(),
        progressivo = $form.find( 'input[name="progressivo"]' ).val();
    	nametext='contenuto_'+progressivo+'_'+lang;

    	if ($form.attr('attr') == 'testo')
    		testo = $form.find( 'textarea[name="'+nametext+'"]' ).val();
    	else
        	testo = $form.find( 'input[name="'+nametext+'"]' ).val();
        	
        	
    	
    		



    /* Send the data using post and put the results in a div */

	$('#'+progressivo+'_'+lang+'_ris').load("<?=base_url('admin/traduzioni/ins_traduzione')?>", { lang: lang , progressivo : progressivo , messaggio : testo}, function(){
		
		});

    
  });


</script>
