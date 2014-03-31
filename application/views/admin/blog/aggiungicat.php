<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/blog/listacat') ?>">Categorie Blog</a></li>
    <li class="active">Aggiungi Categoria Blog</li>
</ol>
<h2>Inserimento Categoria</h2>
<?

echo form_open_multipart('admin/blog/aggiungicatdb');

?>
<div class="row">
<div class="col-sm-9">
<? echo form_input_nci('Nome Categoria','nome', '', 'class="required form-control"'); ?>
</div>
<div class="col-sm-3">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
    <? echo form_submit('mysubmit', 'Pubblica Categoria', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>

</p>
</div>
</div>
</div>
<?php echo form_close();?>