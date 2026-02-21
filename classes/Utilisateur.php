<?php

require "classes/Villes.php";

class Utilisateur
{
  // Attributs
  private int $id;
  private string $nom;
  private string $prenom;
  private string $pseudo;
  private string $motDePasse;
  private int $age;
  private bool $connecte;

  // construsteur
  public function __construct(
    int $uneId,
    string $unNom,
    string $unPrenom,
    string $unPseudo,
    string $uneMotDePasse,
    int $uneAge,
    bool $connecte
  ) {
    $this->id = $uneId;
    $this->nom = $unNom;
    $this->prenom = $unPrenom;
    $this->pseudo = $unPseudo;
    $this->motDePasse = $uneMotDePasse;
    $this->age = $uneAge;
    $this->connecte = $connecte;
  }

  // Getters
  public function getId(): int
  {
    return $this->id;
  }
  public function getNom(): string
  {
    return $this->nom;
  }

  public function getPrenom(): string
  {
    return $this->prenom;
  }

  public function getPseudo(): string
  {
    return $this->pseudo;
  }

  public function getMotDePasse(): string
  {
    return $this->motDePasse;
  }

  public function getAge(): int
  {
    return $this->age;
  }

  //quand vous avez un booléen prenez l'habitude de faire le getter avec is
  public function isConnecte(): bool
  {
    return $this->connecte;
  }



  //Setters
  public function setId(string $uneId): void
  {
    $this->id = $uneId;
  }

  public function setNom(string $unNom): void
  {
    $this->nom = $unNom;
  }

  public function setPrenom(string $unPrenom): void
  {
    $this->prenom = $unPrenom;
  }

  public function setPseudo(string $unPseudo): void
  {
    $this->pseudo = $unPseudo;
  }

  public function setVitessMax(int $uneMotDePasse): void
  {
    $this->motDePasse = $uneMotDePasse;
  }

  public function setAge(int $uneAge): void
  {
    $this->age = $uneAge;
  }

  public function setConnecte(bool $connecte): void
  {
    $this->connecte = $connecte;
  }


  //to string
  public function __toString(): string
  {
    return
      "Nom : " . $this->nom . "<br>" .
      "prenom : " . $this->prenom . "<br>" .
      "pseudo : " . $this->pseudo . "<br>";
  }
}
