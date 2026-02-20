<?php
$title = "Enregistrement";
$nav = "createUser";
require "header.php";
require "bd.php";

// Récupérer toutes les villes
try {
    $stmt = $pdo->query('SELECT * FROM villes ORDER BY nom');
    $villes = $stmt->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Fonction nationalité
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
    return $map[$pays];
}

// Traitement du formulaire
if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['pseudo']) && !empty($_POST['mot_de_passe']) && !empty($_POST['age']) && !empty($_POST['ville'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $mot_de_passe = $_POST['mot_de_passe']; // en clair
    $age = $_POST['age'];
    $id_ville = $_POST['ville'];

    try {
        $req = $pdo->prepare('INSERT INTO utilisateurs (nom, prenom, pseudo, mot_de_passe, age, id_ville) 
                              VALUES(:nom, :prenom, :pseudo, :mot_de_passe, :age, :id_ville)');
        $req->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'mot_de_passe' => $mot_de_passe,
            'age' => $age,
            'id_ville' => $id_ville
        ]);
        echo "<p>L'utilisateur $prenom $nom a été ajouté !</p>";
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>

<center>
    <h1>Enregistrement</h1>
</center>
<div align="center">
    <div class="col-6">
        <form action="" method="POST">
            <input type="text" name="nom" placeholder="Nom" required><br>
            <input type="text" name="prenom" placeholder="Prénom" required><br>
            <input type="text" name="pseudo" placeholder="Pseudo" required><br>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br>
            <input type="number" name="age" placeholder="Age" required><br>

            <label>Ville :</label>
            <select name="ville" required>
                <option value="">-- Sélectionnez une ville --</option>
                <?php foreach ($villes as $ville): ?>
                    <option value="<?= $ville->id_ville ?>"><?= $ville->nom ?> (<?= nationalite($ville->pays) ?>)</option>
                <?php endforeach; ?>
            </select><br><br>

            <button class="btn btn-primary" type="submit">S'enregistrer</button>
        </form>
    </div>
</div>

<?php require "footer.php"; ?>