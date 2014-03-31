<?php echo form_open_multipart('admin/pagine/modifica/'.$pagina[0]->id_pagina); ?>
<?php echo form_hidden('modifica_modulo', $modifica_sin[0]->id_paginemodulo); ?>
<fieldset>
<legend>Modifica Modulo</legend>
<?php 

switch($modifica_sin[0]->tipologia_contenuto) {
	
case 'testo': 
	?>
	<h2>Modifica il testo</h2>
	<?php echo form_hidden('tipo_contenuto', $modifica_sin[0]->tipologia_contenuto); ?>
	<? echo form_textarea_nci('Testo Modulo','contenuto',$modifica_sin[0]->contenuto,'class="ckeditor"'); ?>
	
	<?
	break;
	
case 'gallery':
	?>
	<h2>Seleziona la gallery</h2>
	<?php echo form_hidden('tipo_contenuto', $modifica_sin[0]->tipologia_contenuto); ?>
	<?php
	/* INSERISCO LE CATEGORIE NEL DROPBOX */
	$options = Array(); 
	foreach ($gallerylist as $gallery){
			$options["$gallery->id_gallery"]=$gallery->nome;
	}
	echo form_dropdown_nci('Gallery associata','id_gallery', $options, $modifica_sin[0]->id_contenuto);?>
	<?php
	if (json_decode($modifica_sin[0]->opzioni)->solo_link==1)
	$checkbox=TRUE;
	else
	$checkbox=FALSE;
	echo form_checkbox('solo_link', 'solo_link', $checkbox); ?> Inserire solo link di riferimento
	<?php
	break;
	
case 'video':
	?>
	<h2>Seleziona la Videogallery</h2>
	<?php echo form_hidden('tipo_contenuto', $modifica_sin[0]->tipologia_contenuto); ?>
	<?php
	/* INSERISCO LE CATEGORIE NEL DROPBOX */
	$options = Array(); 
	foreach ($videolist as $video){
			$options["$video->id_videogallery"]=$video->nome;
	}
	echo form_dropdown_nci('Videogallery associata','id_videogallery', $options, $modifica_sin[0]->id_contenuto);?>
	<?php
	if (json_decode($modifica_sin[0]->opzioni)->solo_link==1)
	$checkbox=TRUE;
	else
	$checkbox=FALSE;
	echo form_checkbox('solo_link', 'solo_link', $checkbox); ?> Inserire solo link di riferimento
	<?php
	break;
	
}
?>

<? echo form_submit('mysubmit', 'Modifica Modulo'); ?>


</fieldset>
<?php echo form_close(); ?>