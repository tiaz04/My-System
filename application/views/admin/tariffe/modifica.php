<?php
echo "<h2>Modifica Tariffe ".$tariffa[0]->anno."</h2>";
?>

<?
echo form_open_multipart('admin/tariffe/modificadb/'.$tariffa[0]->id_tariffa);
?>
<div class="col_des_insert">
<div class="modulo">
<p>
<b><a href="../modifica_periodi/<?=$tariffa[0]->id_tariffa?>">&raquo; GESTIONE PERIODI</a></b>
</p>
</div>
<div class="modulo">
<p><b><a href="../modifica_righe/<?=$tariffa[0]->id_tariffa?>">&raquo;
GESTIONE CAMERE</a></b></p>
</div>
<div class="modulo">
<p><b><a href="../aggiungi_tariffa/<?=$tariffa[0]->id_tariffa?>">&raquo;
TARIFFE AGGIUNTIVE</a></b></p>
</div>
<div class="modulo">
<p><label for="mysubmit">Operazioni</label> <? echo form_submit('mysubmit', 'Modifica Tariffe','class="buttonclass"'); ?>
</p>
</div>

</div>
<div class="col_cen"><?php 


$periodiarr = Array(' ',);
$num_periodi=1;
foreach ($tariffa[0]->lista_periodi as $periodo){

	$periodiarr[]="Dal ".unix_to_human_nci($periodo->stagione_dal)."<br>Al ".unix_to_human_nci($periodo->stagione_al);
	$num_periodi++;
}
$tmpl = array ( 'table_open'  => "$info[open_tabella]" );
$this->table->set_template($tmpl);
$this->table->set_heading($periodiarr);

foreach ($tariffa[0]->lista_righe as $righe){
	$arr_riga= Array();
	$arr_riga[0]=$righe->nome;

	foreach ($tariffa[0]->lista_periodi as $periodo){

		foreach($tariffa[0]->lista_prezzi as $prezzi){

			if (($prezzi->id_triga==$righe->id_triga)&&($prezzi->id_tperiodo==$periodo->id_tperiodo)){
				$prezzo = "value=\"".$prezzi->prezzo."\"";
				break;
			}
			else
			$prezzo = "";
		}

		$arr_riga[]="<input type=\"text\" name=\"".$righe->id_triga."_".$periodo->id_tperiodo."\" $prezzo>";
	}


	$this->table->add_row($arr_riga);
}



echo $this->table->generate();

echo form_textarea_nci("Testo Pagina","html",$tariffa[0]->html,'class="ckeditor"');

echo form_close();

?></div>

<?php 

/* TARIFFE AGGIUNTIVE */

foreach($tariffa[0]->lista_tariffe_agg[0]->tariffa as $tariffe_agg){
	
	echo "<form action=\"\" method=\"post\"><input type=\"hidden\" name=\"del_tariffa\" value=\"$tariffe_agg->id_tariffa\"><input style=\"float:right; width:100px; margin-right:250px;\" type=\"submit\" value=\"Elimina Tariffa\"></form>";
	
	echo "<h2>Modifica Tariffe ".$tariffe_agg->nome."</h2>";
	
	echo form_open_multipart('admin/tariffe/modificadb/'.$tariffe_agg->id_tariffa);
?>
<div class="col_des_insert">
<div class="modulo">
<p>
<b><a href="../modifica_periodi/<?=$tariffe_agg->id_tariffa?>">&raquo; GESTIONE COLONNE</a></b>
</p>
</div>
<div class="modulo">
<p><b><a href="../modifica_righe/<?=$tariffe_agg->id_tariffa?>">&raquo;
GESTIONE RIGHE</a></b></p>
</div>
<div class="modulo">
<p><label for="mysubmit">Operazioni</label> <? echo form_submit('mysubmit', 'Modifica Tariffe','class="buttonclass"'); ?>
</p>
</div>
</div>
<div class="col_cen"><?php 


$periodiarr = Array(' ',);
$num_periodi=1;
foreach ($tariffe_agg->lista_periodi as $periodo){

	$periodiarr[]=$periodo->nome_stagione."<br><span style=\"font-size:9px;\">Dal ".unix_to_human_nci($periodo->stagione_dal)."<br>Al ".unix_to_human_nci($periodo->stagione_al)."</span>";
	$num_periodi++;
}
$tmpl = array ( 'table_open'  => "$info[open_tabella]" );
$this->table->set_template($tmpl);
$this->table->set_heading($periodiarr);

if ($tariffe_agg->lista_righe!=""){
foreach ($tariffe_agg->lista_righe as $righe){
	$arr_riga= Array();
	$arr_riga[0]=$righe->nome;

	foreach ($tariffe_agg->lista_periodi as $periodo){

		foreach($tariffe_agg->lista_prezzi as $prezzi){

			if (($prezzi->id_triga==$righe->id_triga)&&($prezzi->id_tperiodo==$periodo->id_tperiodo)){
				$prezzo = "value=\"".$prezzi->prezzo."\"";
				break;
			}
			else
			$prezzo = "";
		}

		$arr_riga[]="<input type=\"text\" name=\"".$righe->id_triga."_".$periodo->id_tperiodo."\" $prezzo>";
	}


	$this->table->add_row($arr_riga);
}
}


echo $this->table->generate();


echo form_close();
	
	
}


?>

