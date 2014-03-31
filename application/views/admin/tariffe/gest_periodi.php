<?php if ($tariffa[0]->tpadre>0) {
$nome_plurale = "colonne";
$nome_singolare = "colonna";
}else{ 
$nome_plurale = "periodi";
$nome_singolare = "stagione";
 } ?>
<h2>Gestione <?=$nome_plurale?></h2>
<div class="col_des_insert">
<div class="modulo">
<p><?php if ($tariffa[0]->tpadre==0) { ?>
<b><a href="../modifica/<?=$tariffa[0]->id_tariffa?>">&laquo; Torna alla gestione tariffa</a></b>
<?php }else{ ?>
<b><a href="../modifica/<?=$tariffa[0]->tpadre?>">&laquo; Torna alla gestione tariffa</a></b>
<?php }?></p>
</div>
</div>
<div class="col_cen">

<table border="0" cellpadding="0" cellspacing="0" class="tabella">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Dal</th>
			<th>Al</th>
			<th>Operazioni</th>
		</tr>
	</thead>
	<tbody>

		<?
		foreach ($tariffa[0]->lista_periodi as $periodi){
			?>
		<tr>
			<td><?=$periodi->nome_stagione?></td>
			<td><?=unix_to_human_nci($periodi->stagione_dal)?></td>
			<td><?=unix_to_human_nci($periodi->stagione_al)?></td>
			<td>
			<div id="mod_<?=$periodi->id_tperiodo?>" class="modifica_bt"
				style="cursor: pointer;"><a>Modifica</a></div>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="padding:0px;">
			<div
				style="padding: 10px; display: none; line-height:1.4;"
				id="sel_mod_<?=$periodi->id_tperiodo?>">
			<div id="mod_<?=$periodi->id_tperiodo?>" class="chiudi_bt"
				style="float: right;cursor:pointer;"><a>[X]</a></div>
			<form action="" method="post" id="<?=$periodi->id_tperiodo?>"><b>Modifica
			<?=$nome_singolare?></b><br>
			<input type="hidden" name="mod_periodo"
				value="<?=$periodi->id_tperiodo?>"> Nome<br>
			<input type="text" name="nome_stagione"
				value="<?=$periodi->nome_stagione?>"><br>
			Dal <br>
			<select name="dal_giorno" style="width: 50px;">
			<?php for ($c=1;$c<=31;$c++){ if ($c==date('j',$periodi->stagione_dal)) { $selected="selected=\"selected\"";}else{$selected="";} echo "<option value=\"$c\" $selected>$c</option>"; }?>
			</select> / <select name="dal_mese" style="width: 50px;">
			<?php for ($c=1;$c<=12;$c++){ if ($c==date('n',$periodi->stagione_dal)) { $selected="selected=\"selected\"";}else{$selected="";} echo "<option value=\"$c\" $selected>$c</option>"; }?>
			</select> / <select name="dal_anno" style="width: 80px;">
			<?php for ($c=2011;$c<=2030;$c++){ if ($c==date('Y',$periodi->stagione_dal)) { $selected="selected=\"selected\"";}else{$selected="";} echo "<option value=\"$c\" $selected>$c</option>"; }?>
			</select><br>
			Al <br>
			<select name="al_giorno" style="width: 50px;">
			<?php for ($c=1;$c<=31;$c++){ if ($c==date('j',$periodi->stagione_al)) { $selected="selected=\"selected\"";}else{$selected="";} echo "<option value=\"$c\" $selected>$c</option>"; }?>
			</select> / <select name="al_mese" style="width: 50px;">
			<?php for ($c=1;$c<=12;$c++){ if ($c==date('n',$periodi->stagione_al)) { $selected="selected=\"selected\"";}else{$selected="";} echo "<option value=\"$c\" $selected>$c</option>"; }?>
			</select> / <select name="al_anno" style="width: 80px;">
			<?php for ($c=2011;$c<=2030;$c++){ if ($c==date('Y',$periodi->stagione_al)) { $selected="selected=\"selected\"";}else{$selected="";} echo "<option value=\"$c\" $selected>$c</option>"; }?>
			</select><br>
			<br>
			<input type="checkbox" value="1" name="cancella" style="width: 20px;">
			Cancellare?<br>
			<br>
			<input type="submit" value="Modifica Stagione"></form>
			</div>
			</td>
		</tr>


		
		<?php

		}

		?>
	</tbody>
</table>

<div style="padding: 10px; margin-top:10px; border-top:1px solid #CCC; line-height:1.4;"><?php
echo form_open_multipart('admin/tariffe/modifica_periodi/'.$tariffa[0]->id_tariffa);
?> <input type="hidden" name="ins_periodo" value="1"> <b>Inserisci Nuova
<?=$nome_singolare?></b><br>
Nome <?=$nome_singolare?><br>
<input type="text" name="nome_stagione"><br>
Dal <br>
<select name="dal_giorno" style="width: 50px;">
<?php for ($c=1;$c<=31;$c++){ echo "<option value=\"$c\">$c</option>"; }?>
</select> / <select name="dal_mese" style="width: 50px;">
<?php for ($c=1;$c<=12;$c++){ echo "<option value=\"$c\">$c</option>"; }?>
</select> / <select name="dal_anno" style="width: 80px;">
<?php for ($c=2011;$c<=2030;$c++){ echo "<option value=\"$c\">$c</option>"; }?>
</select><br>
Al <br>
<select name="al_giorno" style="width: 50px;">
<?php for ($c=1;$c<=31;$c++){ echo "<option value=\"$c\">$c</option>"; }?>
</select> / <select name="al_mese" style="width: 50px;">
<?php for ($c=1;$c<=12;$c++){ echo "<option value=\"$c\">$c</option>"; }?>
</select> / <select name="al_anno" style="width: 80px;">
<?php for ($c=2011;$c<=2030;$c++){ echo "<option value=\"$c\">$c</option>"; }?>
</select><br>
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
