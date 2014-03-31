<div class="col-md-3 col-sm-3"><div class="modulo">
<form name='myForm' id='myForm' method='post' action=''>
<p>
<label>Inserisci nuovi File</label>

Utilizza questo spazio per caricare <b>Nuovi file</b> all'interno della galleria<br><br>
<input type='hidden' id='submitting' name='submitting' value='yes' />
<span id='<?=$tipo_upload?>'>You've got a problem with your JavaScript</span>

<!-- <a href='#' onclick="jQuery('#gallery').uploadifyCancel('*'); return false;">(Cancella tutti)</a> -->
<span id='fileQueue'></span>

<button type="button" name="btSubmit" id="btSubmit" onclick="doFormSubmit<?=$tipo_upload?>()" class="btn btn-primary btn-block btn-lg buttonclass" style="margin-top:5px;">Carica e Invia</button>





</p>
</form>
</div>
<?php if ($tipo_upload == 'video'){ ?>
<div class="modulo">
<form action="" method="post">
<input type="hidden" name="file_link" value="1">
<p>
	<label for="link">Carica Video Youtube</label>
	<input type="text" name="link" value="">
	Inserisci qui il link del video<br> (es. http://youtu.be/6PDd55_yUSo)
	<input type="submit" value="Carica Video" class="buttonclass">
</p>
</form>
</div>
<div class="modulo">
<form action="" method="post">
<input type="hidden" name="file_link" value="2">
<p>
	<label for="link">Carica Video Vimeo</label>
	<input type="text" name="link" value="">
	Inserisci qui il link del video<br> (es. http://vimeo.com/52529733)
	<input type="submit" value="Carica Video" class="buttonclass">
</p>
</form>
</div>
<?php } ?>
    
    <?php if ($tipo_upload == 'file'){ ?>
  <div class="modulo">
<form action="" method="post">
<input type="hidden" name="file_link" value="3">
<p>
	<label for="link">Carica File Esterno</label>
	<input type="text" name="link" value="">
	Inserisci qui il link del file<br>
	<input type="submit" value="Carica File" class="buttonclass">
</p>
</form>
</div>  
    <?php } ?>
    
</div>