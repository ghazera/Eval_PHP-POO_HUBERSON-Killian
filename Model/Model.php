<?php
class Model
{
    private PDO $bdd;

    // creation de notre construct lors de l'appel de notre objet model
    public function __construct()
    {
        try {
            // connexion bdd grâce à nos infos entrées dans notre env.php
            $this->bdd = new PDO(
                'mysql:host='.$_ENV['dbhost'].';dbname='.$_ENV['dbname'].';charset=utf8mb4',
                $_ENV['login'],
                $_ENV['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
            );
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    // Getter pour récupérer notre pdo
    public function getBdd(): PDO
    {
        return $this->bdd;
    }
}
?>
