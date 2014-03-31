<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Categorie Domande & Risposte</li>
</ol>
<h2>Lista Categorie Domande & Risposte <a href="<?= base_url('admin/faq/aggiungicat') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Categoria Domande & Risposte</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Categoria', 'Operazioni');


foreach ($lista_cat as $pagina){

$this->table->add_row($pagina->nome, '<a class="btn btn-primary btn-xs" href="modificacat/'.$pagina->id_faqcat.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs" href="eliminacat/'.$pagina->id_faqcat.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

