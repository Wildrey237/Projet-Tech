<?php
require_once '../modele/Database.php';
require_once '../controller/editprofil.php';
require_once '../controller/session.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Profil </title>
  </head>
  <body>
    <h1>Profil de <?php echo $user["prenom"] . " " . $user["nom"]; ?></h1>
    
    <?php if ($message !== "") { ?>
    <p><?php echo $message; ?></p>
    <?php } ?>

    <form action="../controller/editprofil.php" method="POST">
      <label for="nom">Nom*: </label>
      <input type="text" id="nom" name="nom" value="<?php echo $user["nom"]; ?>"><br>

      <label for="prenom">Prénom*: </label>
      <input type="text" id="prenom" name="prenom" value="<?php echo $user["prenom"]; ?>"><br>

      <label for="mail">Adresse e-mail*: </label>
      <input type="email" id="mail" name="mail" value="<?php echo $user["mail"]; ?>"><br>

      <label for="password">Mot de passe: </label>
      <input type="password" id="password" name="password"><br>

      <label for="date_de_naissance">Date de naissance*: </label>
      <input type="date" id="date_de_naissance" name="date_de_naissance" value="<?php echo $user["date_de_naissance"]; ?>"><br>

      <label for="description">Description: </label>
      <textarea id="description" name="description"><?php echo $user["description"]; ?></textarea><br>

      <label for="ville">Ville: </label>
      <input type="text" id="ville" name="ville" value="<?php echo $user["ville"]; ?>"><br>

      <label for="interests">Centres d'intérêt: </label>
      <input type="text" id="interests" name="interests" value="<?php echo $user["interests"]; ?>"><br>

      <label for="photo">Photo:</label>
      <input type="file" name="photo"><br><br>

      <label for="idpromos">Promotion:</label>
        <select name="idpromos">
            <?php foreach($promotions as $promotion): ?>
                <option value="<?php echo $promotion['idpromos']; ?>"<?php if($promotion['idpromos'] == $user['idpromos']){ echo ' selected'; } ?>><?php echo $promotion['nom_promo']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <input type="submit" name="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>