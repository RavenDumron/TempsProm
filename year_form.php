<!--formulaire de dates à extraire de la base SQL-->

<form action="index.php" method="GET">
    <div class="mb-3">
        <strong><label for="year" class="form-label">Quelle année (début de période) souhaitez-vous extraire ?</label></strong>
        <input input type="number" min="1900" max="2099" step="1" value=<?php echo($year1)?> name='year' id='year' required>
    </div>
    <button type="submit" class="dbtn btn-primary">Go</button>
</form></br>
