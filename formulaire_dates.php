<!--formulaire de dates à extraire de la base SQL-->
<?php
$date_actuelle = getdate();

echo $date_actuelle['year'] . "-" . $date_actuelle['mon'] . "-" . $date_actuelle['mday']
?>

<form action="resultat_dates.php" method="GET">
    <div class="mb-3">
        <strong><label for="date_debut" class="form-label">Date de début</label></strong>
        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
    </div>
    <div class="mb-3">
        <strong><label for="date_fin" class="form-label">Date de fin</label></strong>
        <input type="date" class="form-control" id="date_fin" name="date_fin" max = <?php echo $date_actuelle['year'] . "-" . $date_actuelle['mon'] . "-" . $date_actuelle['mday'] ?> required>
    </div>
    <button type="submit" class="dbtn btn-primary">Go</button>
</form></br>
