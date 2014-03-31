<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/press/listacat') ?>">Categorie Press</a></li>
    <li class="active">Modifica Categoria Press</li>
</ol>
<h2>Modifica Categoria Press</h2>
<?
echo form_open('admin/press/modificacatdb/'.$catpagine[0]->id_presscat);

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

