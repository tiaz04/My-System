<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li class="active">Gallery</li>
</ol>
<h2>Lista Gallery  <a href="<?= base_url('admin/gallery/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Gallery</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Gallery', 'Descrizione','Numero Immagini', 'Operazioni');


foreach ($lista_gallery as $gallery){

$this->table->add_row($gallery->nome, $gallery->descrizione,$gallery->n_file, '<a class="btn btn-success btn-xs" href="gallery/gestione_immagini/'.$gallery->id_gallery.'"><span class="glyphicon glyphicon-picture"></span> Gestione Immagini</a> <a class="btn btn-primary btn-xs" href="gallery/modifica/'.$gallery->id_gallery.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs deletebt" href="gallery/elimina/'.$gallery->id_gallery.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

