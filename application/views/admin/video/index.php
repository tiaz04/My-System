<h2>Lista Videogallery</h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Videogallery', 'Descrizione','Numero Video', 'Operazioni');


foreach ($lista_video as $videogallery){

$this->table->add_row($videogallery->nome, $videogallery->descrizione,$videogallery->n_file, '<a href="video/gestione_video/'.$videogallery->id_videogallery.'">Gestione Video</a> - <a href="video/modifica/'.$videogallery->id_videogallery.'">Modifica</a> - <a href="video/elimina/'.$videogallery->id_videogallery.'">Cancella</a>');

}

echo $this->table->generate();

 ?>
 

