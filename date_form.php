<!--formulaire de dates à extraire de la base SQL-->

<form action="submit_date.php" method="GET">
    <div class="mb-3">
        <strong><label for="start_date" class="form-label">Date de début</label></strong>
        <input type="date" class="form-control" id="start_date" name="start_date" required>
    </div>
    <div class="mb-3">
        <strong><label for="end_date" class="form-label">Date de fin</label></strong>
        <input type="date" class="form-control" id="end_date" name="end_date" required>
    </div>
    <button type="submit" class="dbtn btn-primary">Go</button>
</form></br>
