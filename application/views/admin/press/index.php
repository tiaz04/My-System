<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Press</li>
</ol>
<h2>Lista Press <a href="<?= base_url('admin/press/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Press</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Titolo','Categoria', 'Data','Ultima Modifica', 'Operazioni');


foreach ($lista_press as $press){

$this->table->add_row($press->titolo, $press->cat_press,unix_to_human($press->data),unix_to_human($press->data_modifica), '<a class="btn btn-primary btn-xs" href="press/modifica/'.$press->id_press.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs deletebt" href="press/elimina/'.$press->id_press.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

