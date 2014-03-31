<h2>Inserimento Tariffa</h2>
<?
echo form_open_multipart('admin/tariffe/aggiungi_tariffa_db');
?>

<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Inserici Tariffa','class="buttonclass"'); ?>
</p>
</div>
</div>
<div class="col_cen">
<?php if ($tariffa!=0){ ?>
<?php echo form_hidden('tpadre',$tariffa[0]->id_tariffa);?>
<? echo form_input_nci('Nome Tariffa','nome'); ?>
<?php }else{ ?>
<? echo form_input_nci('Anno','anno'); ?>
Valida dal<br>
<select name="validita_giorno" style="width:60px;">
<?php for ($c=1;$c<=31;$c++){
	if ($c==$data_giorno)
	$giorno_selected="selected=\"selected\"";
	else
	$giorno_selected="";
echo "<option value=\"$c\" $giorno_selected>$c</option>\n";
}?>
</select> / <select name="validita_mese" style="width:60px;">
<?php for ($c=1;$c<=12;$c++){
	if ($c==$data_mese)
	$mese_selected="selected=\"selected\"";
	else
	$mese_selected="";
echo "<option value=\"$c\" $mese_selected>$c</option>\n";
}?>
</select> / <select name="validita_anno" style="width:70px;">
<?php for ($c=2014;$c>=1990;$c--){
	if ($c==$data_anno)
	$anno_selected="selected=\"selected\"";
	else
	$anno_selected="";
echo "<option value=\"$c\" $anno_selected>$c</option>\n";
}?>
</select><br>
<?php
/* INSERISCO LE CATEGORIE NEL DROPBOX */
$options[0]="Si";
$options[1]="No";

echo form_dropdown_nci('Attiva','attiva', $options, '0');?>
<?php  } ?>
</div>
