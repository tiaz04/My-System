<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li class="active">Pagine</li>
</ol>
<h2>Lista Pagine <a href="<?= base_url('admin/pagine/aggiungi') ?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus"></span> Aggiungi Pagina</a></h2>
<?

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Id','Nome Pagina', 'Categoria', 'Ultima Modifica', 'Operazioni');


foreach ($lista_pagine as $pagina){

	if ($pagina->pagina_padre == 0){

		$this->table->add_row($pagina->id_pagina,$pagina->nome, $pagina->cat_pagina, unix_to_human($pagina->modifica), '<a class="btn btn-primary btn-xs" href="pagine/modifica/'.$pagina->id_pagina.'"><span class="glyphicon glyphicon-search"></span> Modifica / Gestione Moduli</a> <a class="btn btn-danger btn-xs deletebt" href="pagine/elimina/'.$pagina->id_pagina.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

		foreach ($lista_pagine as $pagina2){

			if ($pagina2->pagina_padre == $pagina->id_pagina){
				$this->table->add_row($pagina2->id_pagina,'&nbsp;&nbsp;- '.$pagina2->nome, $pagina2->cat_pagina, unix_to_human($pagina2->modifica), '<a class="btn btn-primary btn-xs" href="pagine/modifica/'.$pagina2->id_pagina.'"><span class="glyphicon glyphicon-search"></span> Modifica / Gestione Moduli</a> <a class="btn btn-danger btn-xs deletebt" href="pagine/elimina/'.$pagina2->id_pagina.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');

			foreach ($lista_pagine as $pagina3){

			if ($pagina3->pagina_padre == $pagina2->id_pagina){
				$this->table->add_row($pagina3->id_pagina,'&nbsp;&nbsp;&nbsp;&nbsp;> '.$pagina3->nome, $pagina3->cat_pagina, unix_to_human($pagina3->modifica), '<a class="btn btn-primary btn-xs" href="pagine/modifica/'.$pagina3->id_pagina.'"><span class="glyphicon glyphicon-search"></span> Modifica / Gestione Moduli</a> <a class="btn btn-danger btn-xs deletebt" href="pagine/elimina/'.$pagina3->id_pagina.'"><span class="glyphicon glyphicon-remove"></span> Cancella</a>');


			}

		}
				
				
			}

		}

	}
}
echo $this->table->generate();

?>


