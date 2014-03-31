<h2>Modifica Categoria Pagina</h2>
<?
echo form_open('admin/pagine/modificacatdb/'.$catpagine[0]->id_paginecat);

?>
<div class="col_des_insert">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Categoria','class="buttonclass"'); ?>
</p>
</div>
</div>
<div class="col_cen">
<? echo form_input_nci('Nome Categoria','nome',$catpagine[0]->nome); ?>
<? echo form_input_nci('Link','rewrite',$catpagine[0]->cat_rewrite); ?>
</div>
