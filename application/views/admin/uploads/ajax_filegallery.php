<?php foreach ($lista_file as $file) {
    
    
    if ($file->tipo_ref=="ext_file"){
    
?>
<div class="ajgall_img" rel="<?php echo $file->id_file; ?>">
    <strong><?php echo $file->titolo?></strong><br/>
        <?php echo $file->link?>
</div>

<?php }else{ ?>

<div class="ajgall_img" rel="<?php echo $file->id_file; ?>">
    <strong><?php echo $file->titolo?></strong><br/>
        <?php echo $file->nome_file?>
</div>


<?php } }?>
