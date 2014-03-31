
<div class="col-md-9 col-sm-9">
    <div class="row">
<?php foreach ($lista_file as $file) {
?>
    
    
        
        
        
    
    
<div class="col-xs-6 col-md-3 file_elem_gallery">
	<div style="position:absolute; bottom: 70px;right: 15px;">
	<form method='post' action='' style="float:left; margin-right:4px;">
	<?php echo form_hidden('modify_sin', 'update_img');
	echo form_hidden('mod[]', $file->id_file); 
        
	echo form_button('mysubmit', '<span class="glyphicon glyphicon-pencil"></span>','class="btn btn-success btn-xs modbutton" type="submit"'); 
	echo form_close();
	?><form method='post' action='' style="float:left;" onSubmit="return confirm('Confermi la rimozione del file?');">
	<?php echo form_hidden('delete', $file->id_file);
	echo form_button('mysubmit', '<span class="glyphicon glyphicon-remove"></span>','class="btn btn-danger btn-xs delbutton"'); 
	echo form_close();
	?></div>
	<a class="thumbnail" rel="shadowbox[]" href="<?php echo upload_url($file->nome_file)?>"><img src="<?php echo upload_url($file->nome_file2)?>">
		<h2><?php echo ellipsize($file->titolo,40,.8)?></h2>
	<b>Nome File:</b><br><?echo ellipsize($file->nome_file, 22, .5)?></a>
	

</div>
	<?php 
}?>
        </div>
</div>