<?php

class Livre 
{

    private $id,
            $titre,
            $nbPages,
            $image;

         


    public function __construct($id,$titre,$nbPages,$image)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->nbPages = $nbPages;
        $this->image = $image;
    }

    public function getId()
    {
        return trim(htmlspecialchars($this->id));
    }
    public function setId($id)
    {
        $this->id = trim($id);
    }
    public function getTitre()
    {
        return trim(htmlspecialchars($this->titre));
    }
    public function setTitre($titre)
    {
        $this->titre = trim($titre);
    }
    public function getnbPages()
    {
        return trim(htmlspecialchars($this->nbPages));
    }
    public function setnbPages($nbPages)
    {
        $this->nbPages = trim($nbPages);
    }
    public function getImage()
    {
        return trim(htmlspecialchars($this->image));
    }
    public function setImage($image)
    {
        $this->image = trim($image);
    }
}