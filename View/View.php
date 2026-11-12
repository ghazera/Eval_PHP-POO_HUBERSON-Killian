
<?php 

class View
{
    // Affichage header
    public function displayHeader(): View
    {
        // ici on met en place notre html & le header (entête)
        echo '<!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Supergame</title>
            <link rel="stylesheet" href="src/css/style.css">
        </head>
        <body>
            <header>
                <h1>Supergame</h1>
            </header>';

        return $this;
    }

    // Affichage footer
    public function displayFooter(): View
    {
        // ici on met en place notre pied de page  (footer)
        echo '<footer>
                <p>Supergame - Evaluation PHP POO</p>
              </footer>
        </body>
        </html>';

        return $this;
    }
}

?>
