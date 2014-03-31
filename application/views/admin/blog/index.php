<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Blog</li>
</ol>
<h2>Lista Blog <a href="<?= base_url('admin/blog/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Blog</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Titolo','Categoria', 'Data','Ultima Modifica', 'Operazioni');


foreach ($lista_blog as $blog){

$this->table->add_row($blog->titolo, $blog->cat_blog,unix_to_human($blog->data),unix_to_human($blog->data_modifica), '<a class="btn btn-primary btn-xs" href="blog/modifica/'.$blog->id_blog.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="deletebt btn btn-danger btn-xs" href="blog/elimina/'.$blog->id_blog.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

