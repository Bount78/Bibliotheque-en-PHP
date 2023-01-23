<?php
        require_once "model/Livre.class.php";
        require_once 'model/LivreManager.class.php';
class LivreController
{

    private $livreManager;

    public function __construct()
    {
        $this->livreManager = new LivreManager;
        $this->livreManager->chargementLivre();
    }

    public function afficherLivre()
    {

        $livre = $this->livreManager->getLivre();
        require 'views/livres.views.php';
        unset($_SESSION['alert']);

    }

    public function afficherLivreUn($id) {
        $livre = $this->livreManager->getLivreById($id);
        require "views/afficherLivre.views.php";
        // echo $livre->getId();
    }

    public function ajoutLivre(){
        require "views/ajoutLivre.views.php";
    }

    public function ajoutLivreValidation(){
        $file = $_FILES['image'];
        $repertoire = "public/images/";
        $nomImageAjouter = $this->ajoutImage($file, $repertoire);

        $this->livreManager->ajoutLivreBd($_POST['titre'], $_POST['nbPages'], $nomImageAjouter);

        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Ajout réalisé"
        ];

        header('Location:' . URL . 'livres');
    }

    private function ajoutImage($file, $dir)
    {

        if (!isset($file['name']) || empty($file['name']))
            throw new Exception('Vous devez indiquer une image.');

        if (!file_exists($dir))
            mkdir($dir, 0777);

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $random = rand(0, 99999);
        $target_file = $dir . $random . "_" . $file['name'];

        if (!getimagesize($file['tmp_name']))
            throw new Exception("Le fichier n'est pas une image.");
        if($extension !=="jpg" && $extension !=="jpeg" && $extension !== "png" && $extension !=="gif")
            throw new Exception("L'extension du fichier n'est pas reconnu.");
        if(file_exists($target_file))
            throw new Exception("Le fichier existe déjà.");
        if($file['size'] > 500000)
            throw new Exception("Le fichier est trop gros.");
        if(!move_uploaded_file($file['tmp_name'],$target_file))
            throw new Exception("L'ajout de l'image n'a pas fonctionné.");
        else
            return ($random . "_" . $file['name']);

    }

    public function suppressionLivre($id){
        $nomImage = $this->livreManager->getLivreByID($id)->getImage();
        unlink("public/images/" . $nomImage);
        $this->livreManager->suppressionLivreBD($id);

        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Suppression réalisée"
        ];

        header('Location:' . URL . 'livres');
        
    }
    
    public function modificationLivre($id){
        $livre = $this->livreManager->getLivreByID($id);
        require "views/modifierLivre.views.php";
    }
    
    public function modificationLivreValidation(){
        $imageActuelle = $this->livreManager->getLivreByID($_POST['identifiant'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/" . $imageActuelle);
            $repertoire = "public/images/";
            $nomImageAdd = $this->ajoutImage($file, $repertoire);
        } else {
            $nomImageAdd = $imageActuelle;
        }
        $this->livreManager->modificationLivreBD($_POST['identifiant'], $_POST['titre'], $_POST['nbPages'], $nomImageAdd);

        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Modification réalisée"
        ];


        header('Location:' . URL . 'livres');
    }
}