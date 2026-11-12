<?php 

class ViewHome extends View
{
    private string $message = '';
    private array $datas = [];

    // Getter
    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDatas(): array
    {
        return $this->datas;
    }

    // Setter
    public function setMessage(string $newMessage): ViewHome
    {
        $this->message = $newMessage;
        return $this;
    }

    public function setDatas(array $newDatas): ViewHome
    {
        $this->datas = $newDatas;
        return $this;
    }

    public function displayMain(): ViewHome
    {
        echo '<main>
                <h2>Ajouter un joueur</h2>

                <form action="" method="post">
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo">

                    <label for="score">Score:</label>
                    <input type="number" id="score" name="score">

                    <label for="id_team">Equipe :</label>
                    <select id="id_team" name="id_team">
                        <option value="1">Aucune</option>
                        <option value="2">TeamRocket</option>
                        <option value="3">DreamTeam</option>
                    </select>

                    <input type="submit" name="submit" value="Ajouter">
                </form>';

        // message de confirmation /erreur
        echo '<p>'.htmlspecialchars($this->message,ENT_QUOTES,'UTF-8').'</p>';

        // aficher la liste des joueurs
        echo '<h2>Liste des joueurs</h2>';

        if (count($this->datas) > 0) {
            echo '<ul>';

            foreach ($this->datas as $player) {
                $pseudo = htmlspecialchars($player['pseudo'],ENT_QUOTES,'UTF-8');
                $score = (int) $player['score'];
                $team = htmlspecialchars($player['team'],ENT_QUOTES,'UTF-8');

                echo "<li>{$pseudo}: {$score} points {$team}</li>";
            }
            echo '</ul>';
        } else {
            echo '<p>Aucun joueur trouvé.</p>';
        }

        echo '</main>';

        return $this;
    }

    // affichage dans le bon ordre entête > main > pied de page
    public function displayAll(): void
    {
        $this->displayHeader();
        $this->displayMain();
        $this->displayFooter();
    }
}

?>
