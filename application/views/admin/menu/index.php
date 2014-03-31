<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li class="active">Menu</li>
</ol>
<h2>Lista Menu <a href="<?= base_url('admin/menu/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Menu</a></h2>
<? 

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Menu', 'Numero Pagine', 'Operazioni');


foreach ($lista_menu as $menu){

$this->table->add_row($menu->nome_menu, $menu->n_pagine, '<a class="btn btn-primary btn-xs" href="menu/gestione_menu/'.$menu->id_menu.'"><span class="glyphicon glyphicon-list"></span> Gestione Menu</a> <a class="btn btn-primary btn-xs" href="menu/modifica/'.$menu->id_menu.'"><span class="glyphicon glyphicon-search"></span> Modifica</a> <a class="btn btn-danger btn-xs" href="menu/elimina/'.$menu->id_menu.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

}

echo $this->table->generate();

 ?>
 

