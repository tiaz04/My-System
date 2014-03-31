<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li class="active">Gestione File</li>
</ol>
<h2>Lista Cartelle <a href="<?= base_url('admin/filegallery/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Cartella</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Cartella', 'Descrizione','Numero File', 'Operazioni');


foreach ($lista_filegallery as $filegallery){

$this->table->add_row($filegallery->nome, $filegallery->descrizione,$filegallery->n_file, '<a class="btn btn-success btn-xs" href="filegallery/gestione_file/'.$filegallery->id_filegallery.'"><span class="glyphicon glyphicon-picture"></span> Gestione File</a> <a class="btn btn-primary btn-xs" href="filegallery/modifica/'.$filegallery->id_filegallery.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs deletebt" href="filegallery/elimina/'.$filegallery->id_filegallery.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

