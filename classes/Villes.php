<?php

class Villes
{
    // Attributs
    private int $idVille;
    private string $nom;
    private string $pays;
    private string $capitale;

    // Constructeur
    public function __construct(
        int $unIdVille,
        string $unNom,
        string $unPays,
        string $uneCapitale
    ) {
        $this->idVille = $unIdVille;
        $this->nom = $unNom;
        $this->pays = $unPays;
        $this->capitale = $uneCapitale;
    }

    // Getters
    public function getIdVille(): int
    {
        return $this->idVille;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPays(): string
    {
        return $this->pays;
    }

    public function getCapitale(): string
    {
        return $this->capitale;
    }

    // Méthode nationalité
    public function getNationalite(): string
    {
        $map = [
            "France"    => "Français(e)",
            "Belgique"  => "Belge",
            "Allemagne" => "Allemand(e)",
            "Espagne"   => "Espagnol(e)",
            "Italie"    => "Italien(ne)",
            "Portugal"  => "Portugais(e)",
            "Pays-Bas"  => "Néerlandais(e)",
            "Autriche"  => "Autrichien(ne)",
            "Pologne"   => "Polonais(e)",
            "Grèce"     => "Grec(que)"
        ];

        if (isset($map[$this->pays])) {
            return $map[$this->pays];
        } else {
            return $this->pays;
        }
    }

    // Setters
    public function setIdVille(int $unIdVille): void
    {
        $this->idVille = $unIdVille;
    }

    public function setNom(string $unNom): void
    {
        $this->nom = $unNom;
    }

    public function setPays(string $unPays): void
    {
        $this->pays = $unPays;
    }

    public function setCapitale(string $uneCapitale): void
    {
        $this->capitale = $uneCapitale;
    }

    // To string
    public function __toString(): string
    {
        return
            "Ville : " . $this->nom . "<br>" .
            "Pays : " . $this->pays . "<br>" .
            "Capitale : " . $this->capitale . "<br>" .
            "Nationalité : " . $this->getNationalite() . "<br>";
    }
}

