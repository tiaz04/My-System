<div class="col_cen">
<?php foreach ($lista_file as $file) {
?>
<div class="file_elem_video">
	<div style="background-color:#FFF; padding:3px;width:40px; height:17px; float:right; opacity:0.8; margin-top:4px; border-radius:3px; ">
	<form method='post' action='' style="float:left; margin-right:4px; margin-left:3px;">
	<?php echo form_hidden('modify_sin', 'update_img');
	echo form_hidden('mod[]', $file->id_file); 
	echo form_submit('mysubmit', '','class="modbutton"'); 
	echo form_close();
	?><form method='post' action='' style="float:left;" onSubmit="return confirm('Confermi la rimozione del file?');">
	<?php echo form_hidden('delete', $file->id_file);
	echo form_submit('mysubmit', '','class="delbutton"'); 
	echo form_close();
	?></div>
		<h2><?php echo $file->titolo; ?></h2>
	<b>Nome File:</b> <?echo $file->nome_file?><?echo $file->link?><br /><br />
	<b>Tipo File:</b> <?php if ($file->tipo_ref == 'video') { echo "File Video"; } if ($file->tipo_ref == 'video_youtube') { echo "File Video YOUTUBE"; } if ($file->tipo_ref == 'video_vimeo') { echo "File Video VIMEO"; }?>
	<?php if ($file->tipo_ref == 'video_youtube') { ?>
	<div style="float:right;"><a rel="shadowbox;width=480;height=360;player=swf" title="<?=$file->titolo?>" href="<? echo $file->link?>"><b>Vedi Video</b></a></div>
	<? } else if ($file->tipo_ref == 'video') { ?>
	<div style="float:right;"><a rel="shadowbox;width=480;height=360" title="<?=$file->titolo?>" href="<? echo upload_url($file->nome_file)?>"><b>Vedi Video</b></a></div>
	<? } else if ($file->tipo_ref == 'video_vimeo') { ?>
	<div style="float:right;"><a rel="shadowbox;width=480;height=360;player=swf" title="<?=$file->titolo?>" href="<? echo $file->link?>"><b>Vedi Video</b></a></div>
	<? } ?>
</div>
	<?php 
}?>
</div>