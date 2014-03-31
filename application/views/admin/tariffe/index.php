<h2>Tariffe</h2>
<div class="col_des_insert">
<div class="modulo">
<form action="" method="post">
<input type="hidden" name="upd_generals" value="1">
<p><label for="anno_attivo">Impostazioni Generali</label>
<? 

$lista_anni=Array();
foreach ($lista_tariffe as $tariffe){
	$lista_anni[]=Array($tariffe->anno => $tariffe->anno);
}

?>
<b>Anno Attivo</b>
<?php echo form_dropdown('anno_attivo', $lista_anni,$info['tarifs_option']->tariffa_attiva);?><br>
<b>Visualizzare Anno Successivo</b>
<?php if ($info['tarifs_option']->anno_next==0){
$selected2="selected=\"selected\"";
$selected1="";
}else{
$selected1="selected=\"selected\"";
$selected2="";
}?>
<select name="anno_next"><option value="1" <?=$selected1?>>Si</option><option value="0" <?=$selected2?>>No</option></select>
<br><br><input type="submit" value="Aggiorna Impostazioni">
</p>
</form>
</div>

</div>
<div class="col_cen">
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Anno', 'Validit&agrave;','Attiva', 'Operazioni');


foreach ($lista_tariffe as $tariffe){
	
	if ($tariffe->attivo==1)
	$attivo = "Si";
	else
	$attivo = "No";

$this->table->add_row($tariffe->anno, unix_to_human($tariffe->validita),$attivo, '<a href="tariffe/modifica/'.$tariffe->id_tariffa.'">Modifica</a> - <a href="tariffe/elimina/'.$tariffe->id_tariffa.'">Cancella</a>');

}

echo $this->table->generate();

 ?>
 </div>

