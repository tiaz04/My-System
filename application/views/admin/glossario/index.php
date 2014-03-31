<h2>Glossario</h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Id','Titolo', 'Operazioni');


foreach ($lista_glossario as $gloss){

$this->table->add_row($gloss->id,$gloss->testo, '<a href="glossario/modifica/'.$gloss->id.'">Modifica</a> - <a href="glossario/elimina/'.$gloss->id.'">Cancella</a>');

}

echo $this->table->generate();

 ?>
 

