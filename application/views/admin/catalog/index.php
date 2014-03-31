<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Prodotti</li>
</ol>
<h2>Lista Prodotti <a href="<?= base_url('admin/catalog/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Prodotto</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Titolo','Categoria', 'Data','Ultima Modifica', 'Operazioni');


foreach ($lista_catalog as $catalog){

$this->table->add_row($catalog->titolo, $catalog->cat_catalog,unix_to_human($catalog->data),unix_to_human($catalog->data_modifica), '<a class="btn btn-primary btn-xs" href="catalog/modifica/'.$catalog->id_catalog.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="deletebt btn btn-danger btn-xs" href="catalog/elimina/'.$catalog->id_catalog.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

