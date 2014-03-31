<ol class="breadcrumb">
  <li><a href="<?= base_url('admin/') ?>">Home</a></li>
  <li class="active">Categorie Prodotti</li>
</ol>
<h2>Lista Categorie Prodotti <a href="<?= base_url('admin/catalog/aggiungicat') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Categoria Prodotti</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Categoria', 'Operazioni');


foreach ($lista_cat as $pagina){
    
    if ($pagina->cat_padre==0){

$this->table->add_row($pagina->nome, '<a class="btn btn-primary btn-xs" href="modificacat/'.$pagina->id_catalogcat.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs" href="eliminacat/'.$pagina->id_catalogcat.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

        foreach ($lista_cat as $pagina2){
    
            if ($pagina2->cat_padre == $pagina->id_catalogcat){
               $this->table->add_row('-&nbsp;&nbsp;'.$pagina2->nome, '<a class="btn btn-primary btn-xs" href="modificacat/'.$pagina2->id_catalogcat.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs" href="eliminacat/'.$pagina2->id_catalogcat.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');
 
                
            }
            
            
        }
        }

}

echo $this->table->generate();

 ?>
 

