<?php if ($tariffa[0]->tpadre>0) {
$nome_plurale = "righe";
$nome_singolare = "riga";
}else{ 
$nome_plurale = "camere";
$nome_singolare = "camera";
 } ?>
<h2>Gestione <?=$nome_plurale?></h2>
<div class="col_des_insert">
<div class="modulo">
<p>
<?php if ($tariffa[0]->tpadre==0) { ?>
<b><a href="../modifica/<?=$tariffa[0]->id_tariffa?>">&laquo; Torna alla gestione tariffa</a></b>
<?php }else{ ?>
<b><a href="../modifica/<?=$tariffa[0]->tpadre?>">&laquo; Torna alla gestione tariffa</a></b>
<?php }?>
</p>
</div>
</div>
<div class="col_cen">

<table border="0" cellpadding="0" cellspacing="0" class="tabella">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Ordine</th>
			<th>Operazioni</th>
		</tr>
	</thead>
	<tbody>

<? 
foreach ($tariffa[0]->lista_righe as $righe){
	?>
<tr>
			<td><?=$righe->nome?></td>
			<td><?=$righe->ordine?></td>
			<td>
			<div id="mod_<?=$righe->id_triga?>" class="modifica_bt"
				style="cursor: pointer;"><a>Modifica</a></div>
			</td>
		</tr>
<tr>
<td colspan="3" style="padding:0px;">
<div
	style="padding: 10px; line-height:1.4; display: none;"
	id="sel_mod_<?=$righe->id_triga?>">
<div id="mod_<?=$righe->id_triga?>" class="chiudi_bt"
	style="float: right; cursor:pointer;"><a>[X]</a></div>
<form action="" method="post" id="<?=$righe->id_triga?>"><b>Modifica
<?=$nome_singolare?></b><br>
<input type="hidden" name="mod_riga"
	value="<?=$righe->id_triga?>"> Nome <?=$nome_singolare?><br>
<input type="text" name="nome"
	value="<?=$righe->nome?>"><br>
	Ordine<br>
<input type="text" name="ordine"
	value="<?=$righe->ordine?>"><br>
<br>
<input type="checkbox" value="1" name="cancella" style="width: 20px;">
Cancellare?<br>
<br>
<input type="submit" value="Modifica <?=$nome_singolare?>"></form>
</div>
</td>
</tr>
	


<?php

}
?>
</tbody>
</table>
<div style="padding: 10px; line-height:1.4; margin-top:10px; border-top:1px solid #CCC;"><?php
echo form_open_multipart('admin/tariffe/modifica_righe/'.$tariffa[0]->id_tariffa);
?> <input type="hidden" name="ins_riga" value="1"> <b>Inserisci Nuova
<?=$nome_singolare?></b><br><br>
Nome<br>
<input type="text" name="nome"><br>
Ordine<br>
<input type="text" name="ordine"><br>

<br>
<input type="submit" value="Inserisci <?=$nome_singolare?>">
</form>
</div>
</div>

<script type="text/javascript">
$('.modifica_bt').click(function(){
	var targ = this.id;
	$('#sel_'+targ).slideDown();
});
$('.chiudi_bt').click(function(){
	var targ = this.id;
	$('#sel_'+targ).slideUp();
});



</script>
