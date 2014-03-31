<h2>Lista Elementi</h2>
<?

$tmpl = array ( 'table_open'  => "$info[open_tabella]" );

$this->table->set_template($tmpl);

$this->table->set_heading('Nome Pagina', 'Numero Lingue','Lingue', 'Data', 'Operazioni');

if (isset($lista_pagine)){
	foreach ($lista_pagine as $pagina){

		$this->table->add_row($pagina->nome, '', '',unix_to_human($pagina->modifica), '<a href="../gest_elemento/pagine/'.$pagina->id_pagina.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_news)){
	foreach ($lista_news as $news){

		$this->table->add_row($news->titolo, '', '',unix_to_human($news->data), '<a href="../gest_elemento/news/'.$news->id_news.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_press)){
	foreach ($lista_press as $press){

		$this->table->add_row($press->titolo, '', '',unix_to_human($press->data), '<a href="../gest_elemento/press/'.$press->id_press.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_blog)){
	foreach ($lista_blog as $blog){

		$this->table->add_row($blog->titolo, '', '',unix_to_human($blog->data), '<a href="../gest_elemento/blog/'.$blog->id_blog.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_eventi)){
	foreach ($lista_eventi as $evento){

		$this->table->add_row($evento->titolo, '', '',unix_to_human($evento->data), '<a href="../gest_elemento/evento/'.$evento->id_evento.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_faq)){
	foreach ($lista_faq as $faq){

		$this->table->add_row($faq->domanda, '', '',unix_to_human($faq->data), '<a href="../gest_elemento/faq/'.$faq->id_faq.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_catfaq)){
	foreach ($lista_catfaq as $faq){

		$this->table->add_row($faq->nome, '', '',unix_to_human($faq->data), '<a href="../gest_elemento/catfaq/'.$faq->id_faqcat.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_glossario)){
	foreach ($lista_glossario as $glossario){

		$this->table->add_row($glossario->testo, $glossario->tradotte, $glossario->lingue, '','<a href="../gest_elemento/glossario/'.$glossario->id.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_tariffe)){
	foreach ($lista_tariffe as $tariffa){

		$this->table->add_row($tariffa->anno, '','', '', '<a href="../gest_elemento/tariffe/'.$tariffa->id_tariffa.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_pacchetti)){
	foreach ($lista_pacchetti as $pacchetti){

		$this->table->add_row($pacchetti->nome, '','', '', '<a href="../gest_elemento/pacchetti/'.$pacchetti->id_pacchetto.'">Gestione Traduzioni</a>');

	}
}

if (isset($lista_filegallery)){
	foreach ($lista_filegallery as $filegallery){

		$this->table->add_row($filegallery->titolo." - ".$filegallery->nome_file.$filegallery->link , '','', '', '<a href="../gest_elemento/filegallery/'.$filegallery->id_file.'">Gestione Traduzioni</a>');

	}
}

echo $this->table->generate();

?>


