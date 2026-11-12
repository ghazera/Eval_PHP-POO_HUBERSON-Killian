<?php
class Controller{

    // on met en place nos variables pour aller récupérer notre modele & view via leur nom de classe & on les associe à une variable pour les réutiliser plus bas
    private Model $model;
    private View $view;

    // constructeur qui reçoit le modèle & vue on les appels en utilisant leur nom de Class
    public function __construct(Model $model, View $view){
        $this->model = $model;
        $this->view = $view;
    }

    // Getter 
    public function getModel(): Model{
        return $this->model;
    }
    
    public function getView(): View{
        return $this->view;
    }
    
    // Setter
    
    public function setModel(Model $newModel): Controller{
        $this->model = $newModel;
        return $this;
    }

    public function setView(View $newView): Controller{
        $this->view = $newView;
        return $this;
    }

    // on request à la view de faire le rendu de la page web
    public function render(): void{
        $this->view->displayAll();
    }
}
?>
