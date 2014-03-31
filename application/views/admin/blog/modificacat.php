<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/blog/listacat') ?>">Categorie Blog</a></li>
    <li class="active">Modifica Categoria Blog</li>
</ol>
<h2>Modifica Categoria Blog</h2>
<?
echo form_open('admin/blog/modificacatdb/'.$catpagine[0]->id_blogcat);

?>
<div class="row">
<div class="col-sm-9">
<? echo form_input_nci('Nome Categoria','nome',$catpagine[0]->nome, 'class="required form-control"'); ?>
<? echo form_input_nci('Link','rewrite',$catpagine[0]->cat_rewrite, 'class="required form-control"'); ?>
</div>
<div class="col-sm-3">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
    <? echo form_submit('mysubmit', 'Modifica Categoria', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
</p>
</div>
</div>
    </div>

