<?php
// ici on créer une fonction pour retirer les espaces en début & fin de châine
function sanitize(string $data): string
{
    $data = trim($data);
    return $data;
}
?>
