<div style="border:3px solid #ccc; margin-right:5px;margin-bottom:10px; padding:10px;">
<form name="myForm" id="myForm" method="post" action=''>
    
    <div class="row">

<div class="col-md-9 col-sm-9">
    <h2>Inserisci Informazioni Aggiuntive</h2>
<style>
    .file_mod_gallery p {
     margin-left:0px;   
    }
    </style>
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
	<div class="file_mod_gallery">
            
            <? if ($mod->tipo_ref=="file"){ ?>
            
            <b><? echo $mod->nome_file; ?></b><br/><br/>
        
            <? } ?>
             <? if ($mod->tipo_ref=="ext_file"){ ?>
            
            <b><? echo $mod->link; ?></b><br/><br/>
        
            <? } ?>
            
		<? echo form_input_nci('Titolo File','titolo_'.$mod->id_file,$titolo); ?>
		<? echo form_input_nci('Descrizione','descrizione_'.$mod->id_file,$descrizione); ?>
		<? echo form_input_nci('Ordine','ordine_'.$mod->id_file,$ordine); ?>
		<?php echo form_hidden('mod[]', $mod->id_file); ?>
	</div>
	<?php 
 	
}


?> 
<div style="clear:both;"></div>
</div>
        <div class="col-xs-3">
            <div class="modulo">
<p><label for="mysubmit">Operazioni</label>
<? echo form_submit('mysubmit', 'Aggiorna Modifiche','class="btn btn-primary btn-lg btn-block buttonclass"'); ?>

</p>
<a href="" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Annulla la modifica</a>
</div>
            
        </div>
        
        
    </div>
    
    

    <div style="clear:both;"></div>
</form>
    <div style="clear:both;"></div>
</div>