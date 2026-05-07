<?php include_once ('v_entete.php'); ?>
<div class="container">
<?php
    if (is_null($this->data['leService']))
    {
        echo '<h2>Tous les services</h2>';
    }
    else
    {
        echo '<h2>Service '.$this->data['leService'][0]->GetDesignation().'</h2>';
    }
?>


<div class="mb-3">
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un employé...">
</div>

<table class="table table-striped table-bordered" id="employeeTable">
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Service</th>
            <th>Actions</th> 
        </tr>
    </thead>
    <tbody>
<?php
// Indexe les services pour afficher la designation plutot que le code.
$servicesParCode = array();
if (isset($this->data['lesServices'])) {
    foreach ($this->data['lesServices'] as $unService) {
        $servicesParCode[$unService->GetCode()] = $unService->GetDesignation();
    }
}

foreach ($this->data['lesEmployes'] as $unEmploye) {
    $codeService = $unEmploye->GetService();
    $designationService = isset($servicesParCode[$codeService]) ? $servicesParCode[$codeService] : $codeService;

    echo '<tr>';
    echo '<td>' . htmlspecialchars($unEmploye->GetMatricule()) . '</td>';
    echo '<td>' . htmlspecialchars($unEmploye->GetNom()) . '</td>';
    echo '<td>' . htmlspecialchars($unEmploye->GetPrenom()) . '</td>';
    echo '<td>' . htmlspecialchars($designationService) . '</td>';
    echo '<td>
            <a href="index.php?page=modifierEmploye&matricule=' . urlencode($unEmploye->GetMatricule()) . '" class="btn btn-sm btn-primary" title="Modifier">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                </svg>
            </a>
            <a href="index.php?page=supprimerEmploye&matricule=' . urlencode($unEmploye->GetMatricule()) . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Confirmer la suppression ?\')" title="Supprimer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708"/>
                </svg>
            </a>
          </td>';
    echo '</tr>';
}
?>
</tbody>

</table>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#employeeTable tbody tr');

    rows.forEach(row => {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? '' : 'none';
    });
});
</script>

<?php include_once ('v_piedPage.php'); ?>
