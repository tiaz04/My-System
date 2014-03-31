<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">News</li>
</ol>
<h2>Lista News <a href="<?= base_url('admin/news/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi News</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Titolo','Categoria', 'Data','Ultima Modifica', 'Operazioni');


foreach ($lista_news as $news){

$this->table->add_row($news->titolo, $news->cat_news,unix_to_human($news->data),unix_to_human($news->data_modifica), '<a class="btn btn-primary btn-xs" href="news/modifica/'.$news->id_news.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="deletebt btn btn-danger btn-xs" href="news/elimina/'.$news->id_news.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

