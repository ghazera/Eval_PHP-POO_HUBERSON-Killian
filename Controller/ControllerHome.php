<?php
class ControllerHome extends Controller{

    public function displayPlayers(): ControllerHome{

        // récupérations des joueurs via le model
        $model = $this->getModel();
        $data = $model->findAll(); // findAll est une function non native à php, elle a été créer dans le ModelPlayer.php pour récupérer tt les joueurs

        // on renvoie les données à notre view en définissant notre variable view en récupérant via un getview notre vue pour ensuite y définir nos data via notre setter
        $view = $this->getView();

        $view->setDatas($data);

        return $this;
    }

    public function registerPlayer(): ControllerHome{
        // vérif que le formulaire a été envoyé
        if(isset($_POST['submit'])){

            // on récupère les données transmise depuis le formulaire en utilisant notre utils pour trim nos données
            $pseudo = sanitize($_POST['pseudo'] ?? ""); // l'utilisation de ?? permet de vérifier si pseudo existe et n'est pas null, on récupère sa valeur, ça permet de gagner du temps pour un même résultat tout en utilisant moins de ligne de code par rapport à faire un if(isset...) else...  https://www.php.net/manual/fr/migration70.new-features.php : opérateur Null coalescent 
            $score = $_POST['score'] ?? "";
            $idTeam = $_POST['id_team'] ?? "";

            // on recup la view
            $view = $this->getView();

            // on regarde si les champs sont vide & si oui on renvoie une erreur via le setmessage de notre view en utilisant une comparaison STRICTE === 
            if($pseudo === "" || $score === "" || $idTeam === ""){
                $view->setMessage("Veuillez remplir tous les champs");
            }

            // on vérifie la longueur du pseudonyme du joueur & renvoie une erreur si jamais il dépasse les 50 caractrères
            elseif(strlen($pseudo) > 50){
                $view->setMessage("Le pseudo est trop long");
            }

            // on vérifie si le score & idteam sont bien des nombres entiers (int)
            elseif(
                filter_var($score,FILTER_VALIDATE_INT) === false ||
                filter_var($idTeam,FILTER_VALIDATE_INT) === false
            ){
                $view->setMessage("Veuillez saisir des nombres entiers");
            }

            // on vérifie que le score n'est pas inférieur à 0 
            elseif($score < 0){
                $view->setMessage("Le score ne peut pas être  en négatif");
            }

            // on vérifie si l'id de la team est existant ou non
            elseif($idTeam != 1 && $idTeam != 2 && $idTeam != 3){
                $view->setMessage("Cette équipe n'existe pas");
            }

            else{
                // récupération du modele 
                $model = $this->getModel();

                // on créer notre nouveau joueur en y définissant nos données vérifiés & validées plus haut
                $model->setPseudo($pseudo);
                $model->setScore((int)$score);
                $model->setIdTeam((int)$idTeam);

                // on vérifie si le nom existe déjà
                $data = $model->findByPseudo();

                if($data !== false){
                    $view->setMessage("Ce pseudo est déjà utilisé");
                }
                else{
                    // On créer le joueur via notre function non native add() du fichier ModelPlayer.php
                    $model->add();

                    // on confirme la création du joueur
                    $view->setMessage("Le joueur a bien été créer");
                }
            }
        }

        return $this;
    }
}
?>
