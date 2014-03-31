<h2>Lista Pagine</h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Categoria', 'Operazioni');


foreach ($lista_cat as $pagina){

$this->table->add_row($pagina->nome, '<a href="modificacat/'.$pagina->id_paginecat.'">Modifica</a> - <a href="eliminacat/'.$pagina->id_paginecat.'">Cancella</a>');

}

echo $this->table->generate();

 ?>
 

