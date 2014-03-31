<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/menu') ?>">Menu</a></li>
    <li class="active">Aggiungi Menu</li>
</ol>
<h2>Inserimento Menu</h2>
<?

echo form_open_multipart('admin/menu/aggiungidb');

?>
<div class="row">
    <div class="col-md-9 col-sm-9">
        <? echo form_input_nci('Nome Menu','nome'); ?>

    </div>
    <div class="col-md-3 col-sm-3">
        <div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Inserisci Menu','class="btn btn-primary btn-block btn-lg buttonclass"'); ?>
</p>
</div>
        
    </div>
</div>
<div class="col_des_insert">


</div>
<div class="col_cen">

</div>
