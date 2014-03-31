<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/gallery') ?>">Gallery</a></li>
    <li class="active">Modifica Gallery</li>
</ol>
<h2>Modifica Gallery</h2>
<?
echo form_open('admin/gallery/modificadb/'.$gallery[0]->id_gallery);

?>

<div class="row">
    <div class="col-md-9 col-sm-9">
<? echo form_input_nci('Nome Gallery','nome',$gallery[0]->nome); ?>
<? echo form_textarea_nci('Descrizione','descrizione',$gallery[0]->descrizione); ?>
    </div>
    <div class="col-md-3 col-sm-3">
         <div class="modulo">
            <p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Gallery', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
            </p>
        </div>
    </div>
</div>

