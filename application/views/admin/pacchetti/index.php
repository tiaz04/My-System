<h2>Pacchetti</h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome', 'Anno Listino','Attivo','Stagione 1<br>Periodo1','Stagione 1<br>Periodo2','Stagione 2<br>Periodo1','Stagione 2<br>Periodo2', 'Operazioni');


foreach ($lista_pacchetti as $pacchetti){
	
	if ($pacchetti->attivo==1)
	$attivo="Si";
	else
	$attivo="No";
	
	

$this->table->add_row($pacchetti->nome,
$pacchetti->anno,
$attivo,
'dal '.unix_to_human_nci2($pacchetti->s1periodo1_dal).'<br>al '.unix_to_human_nci2($pacchetti->s1periodo1_al),
'dal '.unix_to_human_nci2($pacchetti->s1periodo2_dal).'<br>al '.unix_to_human_nci2($pacchetti->s1periodo2_al),
'dal '.unix_to_human_nci2($pacchetti->s2periodo1_dal).'<br>al '.unix_to_human_nci2($pacchetti->s2periodo1_al),
'dal '.unix_to_human_nci2($pacchetti->s2periodo2_dal).'<br>al '.unix_to_human_nci2($pacchetti->s2periodo2_al),
'<a href="pacchetti/modifica/'.$pacchetti->id_pacchetto.'">Modifica</a> - <a href="pacchetti/elimina/'.$pacchetti->id_pacchetto.'">Cancella</a>');

}

echo $this->table->generate();

 ?>
 