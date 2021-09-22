<?php
abstract class Controller{
   
    public function render($fichier,  $data = []){
        extract($data);

        // On démarre le buffer de sortie
        ob_start();

        // On génère la vue
        require_once(ROOT.'views/'.strtolower(get_class($this)).'/'.$fichier.'.php');

        // On stocke le contenu dans $content
        $content = ob_get_clean();

        // On fabrique le "template"
        require_once(ROOT.'views/layout/default.php');
    }

   
    public function loadModel($model){
        // On va chercher le fichier correspondant au modèle souhaité
        require_once(ROOT.'models/'.$model.'.php');
        
        // On crée une instance de ce modèle. Ainsi "Article" sera accessible par $this->Article
        $this->$model = new $model();
    }
}