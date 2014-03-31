<div style="border:3px solid #ccc; margin-right:5px;margin-bottom:10px; padding:10px;">
<form name='myForm' id='myForm' method='post' action=''>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Aggiorna Modifiche','class="buttonclass"'); ?>
<a href="">Annulla Modifica</a>
</p>
</div>
</div>
<div class="col_cen">
<h2>Inserisci Informazioni Aggiuntive</h2>

<?php
echo form_hidden('modify', 'update_img');

foreach ($modifiche as $mod){
	if ($ins_multiplo!=1){
		$titolo=$modifiche_file[0]->titolo;
		$descrizione=$modifiche_file[0]->descrizione;
		$ordine=$modifiche_file[0]->ordine;
	}else{
		$titolo="";
		$descrizione="";
		
	}
		
	?>
	<div class="file_mod_video">
	<h2><?=$mod->nome_file?><?=$mod->link?></h2>
		<? echo form_input_nci('Titolo File','titolo_'.$mod->id_file,$titolo); ?>
		<? echo form_input_nci('Descrizione','descrizione_'.$mod->id_file,$descrizione); ?>
		<? echo form_input_nci('Ordine','ordine_'.$mod->id_file,$ordine); ?>
		<?php echo form_hidden('mod[]', $mod->id_file); ?>
	</div>
	<?php 
 	
}


?> 

</div>
</form></div>