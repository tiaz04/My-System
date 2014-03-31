<h2>Eventi</h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Titolo', 'Data','Data Fine','Ultima Modifica', 'Operazioni');


foreach ($lista_eventi as $evento){

$this->table->add_row($evento->titolo, unix_to_human($evento->data), unix_to_human($evento->data_end),unix_to_human($evento->data_modifica), '<a href="eventi/modifica/'.$evento->id_evento.'">Modifica</a> - <a href="eventi/elimina/'.$evento->id_evento.'">Cancella</a>');

}

echo $this->table->generate();

 ?>
 

