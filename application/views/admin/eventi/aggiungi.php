<script>
  $(document).ready(function(){
    $("#tobevalidate").validate();
  });
  </script>
<h2>Inserimento Evento</h2>
<?

$attributes = array('id' => 'tobevalidate');

echo form_open_multipart('admin/eventi/aggiungidb',$attributes);

$data_giorno=date('j',mktime());
$data_mese=date('n',mktime());
$data_anno=date('Y',mktime());

$datafine_giorno=date('j',mktime());
$datafine_mese=date('n',mktime());
$datafine_anno=date('Y',mktime())+2;

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica Evento','class="buttonclass"'); ?>
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
<?php for ($c=2018;$c>=1990;$c--){
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
</select> / <select name="datafine_mese" style="width:60px;">
<?php for ($c=1;$c<=12;$c++){
	if ($c==$datafine_mese)
	$mese_selected="selected=\"selected\"";
	else
	$mese_selected="";
echo "<option value=\"$c\" $mese_selected>$c</option>\n";
}?>
</select> / <select name="datafine_anno" style="width:70px;">
<?php for ($c=2018;$c>=1990;$c--){
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
<?php echo form_input_nci('Link Correlato','link','','','Link da inserire al termine dell\'articolo');?>

</div>
<div class="modulo">
<?php echo form_input_nci('Tags (separati da ,)','tags');?>
</div>
<div class="modulo">
<p><label for="myfile">Immagine Evento</label><input type="file" name="userfile">
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
echo form_dropdown_nci('Gallery associata','id_gallery', $options, '0');?>
</div>
</div>
<div class="col_cen">
<? echo form_input_nci('Titolo Evento','titolo','','class="required"'); ?>
<? echo form_input_nci('Sottotitolo','sottotitolo'); ?>
<? echo form_textarea_nci('Testo Evento','testo','','class="ckeditor required"'); ?>
</div>

