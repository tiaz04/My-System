<div class="row">
<?php foreach ($lista_file as $file) {
?>

    <div class="col-sm-3">
<a href="#" class="ajgall_img thumbnail" rel="<?php echo $file->id_file; ?>"><img src="<?php echo upload_url($file->nome_file2)?>"></a></div>

<?php }?>
</div>