<?php


// Fonction nationalité nisrine
function nationalite($pays)
{
  $map = [
    "France" => "Français",
    "Belgique" => "Belge",
    "Allemagne" => "Allemand",
    "Espagne" => "Espagnol",
    "Italie" => "Italien",
    "Portugal" => "Portugais",
    "Pays-Bas" => "Néerlandais",
    "Autriche" => "Autrichien",
    "Pologne" => "Polonais",
    "Grèce" => "Grec"
  ];
  if (isset($map[$pays])) {
    return $map[$pays];
  } else {
    return $pays;
  }
}
