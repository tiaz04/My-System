<ol class="breadcrumb">
    <li><a href="<?= base_url('admin/') ?>">Home</a></li>
    <li><a href="<?= base_url('admin/filegallery') ?>">Gestione File</a></li>
    <li class="active">Gestione File</li>
</ol>
<h2>Gestione File / <?=$info_filegallery[0]->nome?></h2>
<div id="messaggio"><?

if (isset($modifiche_res)){
if ($modifiche_res==1)
echo "<div class=\"alert alert-dismissable alert-success\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  File modificati con successo
</div>";
else
    echo "<div class=\"alert alert-dismissable alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  Errore nella modifca del file
</div>";
} ?>
<?
if (isset($cancella_res)){
if ($cancella_res==1)
echo "<div class=\"alert alert-dismissable alert-success\">
  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  File cancellato con successo
</div>";
else
echo "<div class=\"alert alert-dismissable alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>
  Errore nella cancellazione del file
</div>";
}
?>
</div>


