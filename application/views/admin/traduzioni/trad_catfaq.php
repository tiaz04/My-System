<h2>Traduzione Pagina <?=$elementi[0]->nome?></h2>
<div class="elem_trad pic">
<div class="col_sin_trad">
<h2>Nome Italiano</h2>
<?=$elementi[0]->nome?></div>
<div class="col_des_trad"><?php  foreach ($info['lingue'] as $lang => $lang_pic) {


	if ($lang!="it"){
			

		echo "<a class=\"gotolang\" where=\"".$lang."_".$elementi[0]->lang_nome."\" target=\"cont_".$elementi[0]->lang_nome."\">$lang_pic</a> ";
	} }?>
<div class="col_des_cont" id="cont_<?=$elementi[0]->lang_nome?>"><?php foreach ($info['lingue'] as $lang => $lang_pic) {

	if ($lang!="it"){

		foreach ($elementi[0]->nome_traduzioni as $trad){
			if ($trad->lang==$lang){
				$contenuto_trad=$trad->messaggio;
				break;
			}
			else
			$contenuto_trad="";
		}

		?>
<div id="<?=$lang?>_<?=$elementi[0]->lang_nome?>" class="cont_trad">
<form action="" method="post" class="carica_trad">
<h2><?php echo $lang_pic;?></h2>
		<? echo form_input_nci('Testo Modulo','contenuto_'.$elementi[0]->lang_nome.'_'.$lang,$contenuto_trad); ?>
<br>
<input type="hidden" name="lang" value="<?=$lang?>"> <input
	type="hidden" name="progressivo" value="<?=$elementi[0]->lang_nome?>"> <input
	type="submit" value="Aggiorna Traduzione">
<div id="<?=$elementi[0]->lang_nome?>_<?=$lang?>_ris"></div>
</form>
</div>
		<?php
	}
}?></div>
</div>
<div style="clear: both;"></div>
</div>



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
