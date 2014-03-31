<h2>Modifica Evento</h2>
<?
echo form_open_multipart('admin/eventi/modificadb/'.$evento[0]->id_evento);

$data_giorno=date('j',$evento[0]->data);
$data_mese=date('n',$evento[0]->data);
$data_anno=date('Y',$evento[0]->data);

$datafine_giorno=date('j',$evento[0]->data_end);
$datafine_mese=date('n',$evento[0]->data_end);
$datafine_anno=date('Y',$evento[0]->data_end);

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Evento','class="buttonclass"'); ?>
</p>
</div>
<div class="modulo">
<p><label for="data">Data Evento</label>
<select name="data_giorno" style="width:60px;">
<?php for ($c=1;$c<=31;$c++){
	if ($c==$data_giorno)
	$giorno_selected="selected=\"selected\"";
	else
	$giorno_selected="";
echo "<option value=\"$c\" $giorno_selected>$c</option>\n";
}?>
</select> / <select name="data_mese" style="width:60px;">
<?php for ($c=1;$c<=12;$c++){
	if ($c==$data_mese)
	$mese_selected="selected=\"selected\"";
	else
	$mese_selected="";
echo "<option value=\"$c\" $mese_selected>$c</option>\n";
}?>
</select> / <select name="data_anno" style="width:70px;">
<?php for ($c=2013;$c>=1990;$c--){
	if ($c==$data_anno)
	$anno_selected="selected=\"selected\"";
	else
	$anno_selected="";
echo "<option value=\"$c\" $anno_selected>$c</option>\n";
}?>
</select>
</p>
</div>
<div class="modulo">
<p><label for="data">Data Fine Evento</label>
<select name="datafine_giorno" style="width:60px;">
<?php for ($c=1;$c<=31;$c++){
	if ($c==$datafine_giorno)
	$giorno_selected="selected=\"selected\"";
	else
	$giorno_selected="";
echo "<option value=\"$c\" $giorno_selected>$c</option>\n";
}?>
</select> / <select name="data_mese" style="width:60px;">
<?php for ($c=1;$c<=12;$c++){
	if ($c==$datafine_mese)
	$mese_selected="selected=\"selected\"";
	else
	$mese_selected="";
echo "<option value=\"$c\" $mese_selected>$c</option>\n";
}?>
</select> / <select name="datafine_anno" style="width:70px;">
<?php for ($c=2015;$c>=1990;$c--){
	if ($c==$datafine_anno)
	$anno_selected="selected=\"selected\"";
	else
	$anno_selected="";
echo "<option value=\"$c\" $anno_selected>$c</option>\n";
}?>
</select>
</p>
</div>
<div class="modulo">
<?php echo form_input_nci('Link','titolo_rewrite',$evento[0]->titolo_rewrite,'','Link della pagina');?>

</div>
<div class="modulo">
<?php echo form_input_nci('Link Correlato','link',$evento[0]->link,'','Link da inserire al termine dell\'articolo');?>

</div>
<div class="modulo">
<?php echo form_input_nci('Tags (separati da ,)','tags',$evento[0]->tags);?>
</div>
<div class="modulo">
<p>

<label for="myfile">Immagine Evento</label>
<?php if ($evento[0]->img!=""){ ?>
<a href="<?=upload_url($evento[0]->img)?>" target="_blank"><img src="<?=upload_url($evento[0]->img)?>" width="100"></a><br>
<input type="checkbox" value="1" name="del_img" style="width:20px;"> Cancella Immagine
<?php }?>
<input type="file" name="userfile">
</p>
</div>

<div class="modulo">
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options = Array(); 
$options[0]="Nessuna Gallery";
foreach ($gallerylist as $gallery){
		$options["$gallery->id_gallery"]=$gallery->nome;
}
echo form_dropdown_nci('Gallery associata','id_gallery', $options, $evento[0]->id_gallery);?>
</div>
</div>
<div class="col_cen">
<? echo form_input_nci('Titolo Evento','titolo',$evento[0]->titolo); ?>
<? echo form_input_nci('Sottotitolo','sottotitolo',$evento[0]->sottotitolo); ?>
<? echo form_textarea_nci('Testo Evento','testo',$evento[0]->testo,'class="ckeditor"'); ?>
</div>
