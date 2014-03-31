<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/filegallery') ?>">Gestione File</a></li>
    <li class="active">Modifica Cartelle</li>
</ol>
<h2>Modifica Cartella</h2>
    <?
echo form_open('admin/filegallery/modificadb/'.$gallery[0]->id_filegallery);

?>
<div class="row">
    <div class="col-md-9 col-sm-9">
<? echo form_input_nci('Nome Cartella','nome',$gallery[0]->nome); ?>
<? echo form_textarea_nci('Descrizione','descrizione',$gallery[0]->descrizione); ?>
    </div>
    <div class="col-md-3 col-sm-3">
         <div class="modulo">
            <p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Modifica Cartella', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
            </p>
        </div>
    </div>
</div>
