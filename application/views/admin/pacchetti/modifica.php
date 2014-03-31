<h2>Modifica Pacchetto</h2>
<?php echo form_open_multipart('admin/pacchetti/modificadb/'.$pacchetto[0]->id_pacchetto); ?>
<div class="col_des_insert">
	<div class="modulo">
		<p>
			<label for="mysubmit">Operazioni</label>
			<? echo form_submit('mysubmit', 'Modifica Pacchetto','class="buttonclass"'); ?>
		</p>
	</div>
	<div class="modulo">
	<?php echo form_input_nci('Anno Listino','anno',$pacchetto[0]->anno,'','');?>
	</div>
	<div class="modulo">
<p>

<label for="myfile">Immagine Pacchetto</label>
<?php if ($pacchetto[0]->img!=""){ ?>
<a href="<?=upload_url($pacchetto[0]->img)?>" target="_blank"><img src="<?=upload_url($pacchetto[0]->img)?>" width="100"></a><br>
<input type="checkbox" value="1" name="del_img" style="width:20px;"> Cancella Immagine
<?php }?>
<input type="file" name="userfile">
</p>
</div>
	<div class="modulo">
		<p>
			<label for="attivo">Attivo</label>
			<select name="attivo">
			<?php if ($pacchetto[0]->attivo==1) { ?>
				<option value="0">No</option>
				<option value="1" selected="selected">Si</option>
			<?php } else { ?>
				<option value="0" selected="selected">No</option>
				<option value="1" >Si</option>
			<?php } ?>
			</select>
		</p>
	</div>
	<div class="modulo">
		<p>
			<label for="strategia">Strategia di pubblicazione</label>
			<?php if ($pacchetto[0]->strategia=="switch") { ?>
			<input type="radio" name="strategia" value="switch" style="width:20px;" checked="checked"> Switch<br>
			<input type="radio" name="strategia" value="periodo" style="width:20px;"> A periodo<br>
			<?php } else { ?>
			<input type="radio" name="strategia" value="switch" style="width:20px;" > Switch<br>
			<input type="radio" name="strategia" value="periodo" style="width:20px;" checked="checked"> A periodo<br>
			<?php } ?>
				Visibile dal (f.to GG/MM/AAAA) <input type="text" name="visibile_dal" value="<?=unix_to_human_nci2($pacchetto[0]->visibile_dal)?>">
				Al (f.to GG/MM/AAAA) <input type="text" name="visibile_al" value="<?=unix_to_human_nci2($pacchetto[0]->visibile_al)?>">			
		</p>
	</div>
</div>
<div class="col_cen">
	<? echo form_input_nci('Nome Pacchetto','nome',$pacchetto[0]->nome); ?>
	<? echo form_textarea_nci('Descrizione','descrizione',$pacchetto[0]->descrizione,'class="ckeditor"'); ?>
	<h3>Stagionalit&agrave; / Periodi</h3>
	<table width="100%" class="tabella">
		<tbody>
			<tr>
				<td rowspan="2">Tipo Stagione 1</td>
				<td>Periodo 1 - dal (f.to GG/MM/AAAA)
				<input type="text" name="s1periodo1_dal" value="<?=unix_to_human_nci2($pacchetto[0]->s1periodo1_dal)?>"></td><td>Al (f.to GG/MM/AAAA)
				<input type="text" name="s1periodo1_al" value="<?=unix_to_human_nci2($pacchetto[0]->s1periodo1_al)?>">
				</td>
			</tr>
			<tr>
				<td>Periodo 2 - dal (f.to GG/MM/AAAA)
				<input type="text" name="s1periodo2_dal" value="<?=unix_to_human_nci2($pacchetto[0]->s1periodo2_dal)?>"></td><td>Al (f.to GG/MM/AAAA)
				<input type="text" name="s1periodo2_al" value="<?=unix_to_human_nci2($pacchetto[0]->s1periodo2_al)?>">
				</td>
			</tr>
			<tr>
				<td rowspan="2">Tipo Stagione 2</td>
				<td>Periodo 1 - dal (f.to GG/MM/AAAA)
				<input type="text" name="s2periodo1_dal" value="<?=unix_to_human_nci2($pacchetto[0]->s2periodo1_dal)?>"></td><td>Al (f.to GG/MM/AAAA)
				<input type="text" name="s2periodo1_al" value="<?=unix_to_human_nci2($pacchetto[0]->s2periodo1_al)?>">
				</td>
			</tr>
			<tr>
				<td>Periodo 2 - dal (f.to GG/MM/AAAA)
				<input type="text" name="s2periodo2_dal" value="<?=unix_to_human_nci2($pacchetto[0]->s2periodo2_dal)?>"></td><td>Al (f.to GG/MM/AAAA)
				<input type="text" name="s2periodo2_al" value="<?=unix_to_human_nci2($pacchetto[0]->s2periodo2_al)?>">
				</td>
			</tr>
		</tbody>
	</table>
	<h3>Tipologie di camere/prezzi</h3>
	<?php 

	
	$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

	$this->table->set_template($tmpl);

	$this->table->set_heading('Tipo Camera', 'Attivo','Prezzo Stagione 1', 'Prezzo Stagione 2');

	$c=0;
	foreach ($info['pacchetti_camere'] as $key => $camere){

	if ($pacchetto[0]->lista_prezzi[$c]->attivo==1){
	$attivo1="checked=\"checked\"";
	$attivo2="";
	}else{
	$attivo1="";
	$attivo2="checked=\"checked\"";
	}	
	$this->table->add_row($camere, "<input type=\"radio\" value=\"1\" name=\"".$key."-active\" style=\"width:20px;\" $attivo1> Si <input type=\"radio\" value=\"0\" name=\"".$key."-active\" style=\"width:20px;\" $attivo2> No", "<input type=\"text\" name=\"".$key."-s1\" value=\"".$pacchetto[0]->lista_prezzi[$c]->prezzos1."\">","<input type=\"text\" name=\"".$key."-s2\" value=\"".$pacchetto[0]->lista_prezzi[$c]->prezzos2."\">");
	$c++;
	}

	echo $this->table->generate();
	
	?>
	
	<br><br>
</div>
