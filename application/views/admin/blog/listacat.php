<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Categorie Blog</li>
</ol>
<h2>Lista Categorie Blog <a href="<?= base_url('admin/blog/aggiungicat') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Categoria Blog</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Categoria', 'Operazioni');


foreach ($lista_cat as $pagina){

$this->table->add_row($pagina->nome, '<a class="btn btn-primary btn-xs" href="modificacat/'.$pagina->id_blogcat.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs" href="eliminacat/'.$pagina->id_blogcat.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

