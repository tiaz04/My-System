<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/filegallery') ?>">Gestione File</a></li>
    <li class="active">Aggiungi Cartella</li>
</ol>
<h2>Inserimento Cartella</h2>
<?

echo form_open_multipart('admin/filegallery/aggiungidb');

?>



<div class="row">
    <div class="col-md-9 col-sm-9">
<? echo form_input_nci('Nome Cartella', 'nome'); ?>
        <? echo form_textarea_nci('Descrizione', 'descrizione'); ?>
    </div>
    <div class="col-md-3 col-sm-3">
        <div class="modulo">
            <p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Pubblica Cartella', 'class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
            </p>
        </div>
    </div>
</div>
