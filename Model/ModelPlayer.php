<?php
class ModelPlayer extends Model
{
    // variables
    private int $id = 0;
    private string $pseudo = '';
    private int $score = 0;
    private string $team = '';
    private int $idTeam = 1;

    // Getters 
    public function getId(): int
    {
        return $this->id;
    }

    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getTeam(): string
    {
        return $this->team;
    }

    public function getIdTeam(): int
    {
        return $this->idTeam;
    }
    
    // setters

    public function setId(int $newId): ModelPlayer
    {
        $this->id = $newId;
        return $this;
    }

    public function setPseudo(string $newPseudo): ModelPlayer
    {
        $this->pseudo = $newPseudo;
        return $this;
    }

    public function setScore(int $newScore): ModelPlayer
    {
        $this->score = $newScore;
        return $this;
    }

    public function setTeam(string $newTeam): ModelPlayer
    {
        $this->team = $newTeam;
        return $this;
    }

    public function setIdTeam(int $newIdTeam): ModelPlayer
    {
        $this->idTeam = $newIdTeam;
        return $this;
    }

    // Récupérer tous les joueurs & leur équipe assignées
    public function findAll(): array
    {
        try {
            $request = $this->getBdd()->prepare(
                "SELECT p.id_player, p.pseudo, p.score, t.team FROM player p
                INNER JOIN team t ON p.id_team = t.id_team
                ORDER BY p.id_player ASC;",
            );

            $request->execute();
            $data = $request->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    // Rechercher un joueur grâce à son pseudo
    public function findByPseudo(): array|bool
    {
        try {
            $request = $this->getBdd()->prepare(
                "SELECT p.id_player, p.pseudo, p.score, t.team FROM player p
                INNER JOIN team t ON p.id_team = t.id_team
                WHERE p.pseudo = ?;",
            );

            $pseudo = $this->getPseudo();
            $request->bindParam(1,$pseudo,PDO::PARAM_STR);
            $request->execute();
            $data = $request->fetch(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    // ajouter un joueur dans la bdd
    public function add(): void
    {
        try {
            $request = $this->getBdd()->prepare(
                "INSERT INTO player (pseudo,score,id_team)
                VALUES (?,?,?);",
            );

            $pseudo = $this->getPseudo();
            $score = $this->getScore();
            $idTeam = $this->getIdTeam();
            
            //on met en place nos bindparam pour placer nos valeurs dans les bons emplacement

            $request->bindParam(1,$pseudo,PDO::PARAM_STR);
            $request->bindParam(2,$score,PDO::PARAM_INT);
            $request->bindParam(3,$idTeam,PDO::PARAM_INT);

            $request->execute();
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    // supprimer un joueur via id
    public function delete(): void
    {
        try {
            $request = $this->getBdd()->prepare('DELETE FROM player WHERE id_player = ?;');

            $id = $this->getId();
            
            //On met en place notre bindparam pour placer notre valeur dans le bon emplacement

            $request->bindParam(1, $id, PDO::PARAM_INT);

            $request->execute();
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    // Modifier les informations d'un joueur
    public function update(): void
    {
        try {
            $request = $this->getBdd()->prepare(
                "UPDATE player SET pseudo = ?, score = ?, id_team = ?
                WHERE id_player = ?;",
            );
            
            // on définit la valeur de nos variable via les getters

            $pseudo = $this->getPseudo();
            $score = $this->getScore();
            $idTeam = $this->getIdTeam();
            $id = $this->getId();
            
            //on met en place nos bindparam pour placer nos valeurs dans les bons emplacement

            $request->bindParam(1,$pseudo,PDO::PARAM_STR);
            $request->bindParam(2,$score,PDO::PARAM_INT);
            $request->bindParam(3,$idTeam,PDO::PARAM_INT);
            $request->bindParam(4,$id,PDO::PARAM_INT); // bind parametre pour le Where

            $request->execute();
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
}
?>
