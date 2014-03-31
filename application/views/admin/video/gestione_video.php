<h2>Gestione Video &raquo; <?=$info_videogallery[0]->nome?></h2>
<div id="messaggio"><?

if (isset($modifiche_res)){
if ($modifiche_res==1)
echo "Video modificato con successo";
else
echo "Errore nella modifica dei video";
} ?>
<?
if (isset($cancella_res)){
if ($cancella_res==1)
echo "Video cancellato con successo";
else
echo "Errore nella cancellazione del video";
}
?>
</div>


