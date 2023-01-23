<?php

require_once 'Model.class.php';
require_once 'Livre.class.php';
class LivreManager extends Model{

    private $livres;

    public function ajoutLivre($livre)
    {
        $this->livres[] = $livre;
    }

    public function getLivre()
    {
        return $this->livres;
    }


    public function chargementLivre()
    {
        $req = $this->getBdd()->prepare('SELECT * FROM livres');
        $req->execute();
        $mesLivres = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach ($mesLivres as $livre) {
            $l = new Livre($livre['id'], $livre['titre'], $livre['nbpages'], $livre['image']);
            $this->ajoutLivre($l);
        }
    }

    public function getLivreByID($id) 
    {
        for($i=0; $i <count($this->livres);$i++){
            if($this->livres[$i]->getId() === $id){
                return $this->livres[$i];
            }
        }
        throw new Exception("Le livre n'existe pas.");
    }

    public function ajoutLivreBd($titre,$nbPages,$image){
        $req = "INSERT INTO livres (titre, nbPages, image) VALUES (:titre, :nbPages, :image)";

        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":titre", $titre, PDO::PARAM_STR);
        $statement->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $statement->bindValue(":image", $image, PDO::PARAM_STR);
        $resultat = $statement->execute();
        $statement->closeCursor();

        if($resultat > 0 ){
            $livre = new Livre($this->getBdd()->lastInsertId(), $titre, $nbPages, $image);
            $this->ajoutLivre($livre);
        }
    }

    public function suppressionLivreBD($id){
        $req = "
        Delete from livres where id = :idLivre";
        $statement = $this->getBdd()->prepare($req);
        $statement->bindValue(":idLivre", $id, PDO::PARAM_INT);
        $resultat = $statement->execute();
        $statement->closeCursor();
        if($resultat > 0 ){
            $livre = $this->getLivreByID($id);
            unset($livre);
        }
    }

    public function modificationLivreBD($id,$titre,$nbPages,$image) {
        $req = "
        
        update livres
        set titre = :titre, nbPages = :nbPages, image =:image
        where id = :id";

        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":titre", $titre, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);

        $resultat = $stmt->execute();

        if($resultat > 0 ){
            $this->getLivreByID($id)->setTitre($titre);
            $this->getLivreByID($id)->setTitre($nbPages);
            $this->getLivreByID($id)->setTitre($image);
        }
    }
}