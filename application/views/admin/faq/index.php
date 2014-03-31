<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Domande & Risposte</li>
</ol>
<h2>Lista Domande & Risposte <a href="<?= base_url('admin/faq/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Domande & Risposte</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Domanda','Categoria', 'Data','Ultima Modifica', 'Operazioni');


foreach ($lista_faq as $faq){

$this->table->add_row($faq->domanda, $faq->cat_faq,unix_to_human($faq->data),unix_to_human($faq->data_modifica), '<a class="btn btn-primary btn-xs" href="faq/modifica/'.$faq->id_faq.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="deletebt btn btn-danger btn-xs" href="faq/elimina/'.$faq->id_faq.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

