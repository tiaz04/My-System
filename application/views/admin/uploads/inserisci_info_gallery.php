<div style="border:3px solid #ccc; margin-right:5px;margin-bottom:10px; padding:10px;">
    <h3>Inserisci Informazioni Aggiuntive</h3>
<form name="myForm" id="myForm" method="post" action=''>
    <div class="row">

<div class="col-md-9 col-sm-9">
   


<?php
echo form_hidden('modify', 'update_img');

foreach ($modifiche as $mod){
	if ($ins_multiplo!=1){
		$titolo=$modifiche_file[0]->titolo;
		$descrizione=$modifiche_file[0]->descrizione;
		$ordine=$modifiche_file[0]->ordine;
	}else{
		$titolo="";
		$descrizione="";
		
	}
		
	?>

 <div class="row" style="margin-bottom:20px;">
        <div class="col-md-3 col-sm-3">
            <img src="<?php echo upload_url($mod->nome_file2); ?>">
        </div>
     <div class="col-md-9 col-sm-9">
         <? echo form_input_nci('Titolo File','titolo_'.$mod->id_file,$titolo); ?>
		<? echo form_input_nci('Descrizione','descrizione_'.$mod->id_file,$descrizione); ?>
		<? echo form_input_nci('Ordine','ordine_'.$mod->id_file,$ordine); ?>
		<?php echo form_hidden('mod[]', $mod->id_file); ?>
     </div>
        
    </div>


	
	<?php 
 	
}


?> 
</div>
        <div class="col-md-3 col-sm-3">
<div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Aggiorna Modifiche','class="btn btn-primary btn-lg btn-block buttonclass"'); ?>

</p>
<a href="" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Annulla la modifica</a>
</div>
</div>
</form></div></div>