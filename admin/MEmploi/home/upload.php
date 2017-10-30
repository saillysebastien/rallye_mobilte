<?php
require('../../../config/db_home.php');
include('../include/header.php');

try {
  $db = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_base
  );
}
catch (Exception $e) {
  die('Erreur : ' . $e->getMessage());
}

$done = false;
$text = '';
$title = '';
$informations =[];

if (isset($_POST['upload'])) {
  $image = $_FILES['image'];
  $imageName = $_FILES['image']['name'];
  $imageTmpName = $_FILES['image']['tmp_name'];
  $imageSize = $_FILES['image']['size'];
  $imageError = $_FILES['image']['error'];
  $imageType = $_FILES['image']['type'];

  $imageExt = explode('.', $imageName);
  $imageActualExt = strtolower(end($imageExt));

  $allowed = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

  if (in_array($imageActualExt, $allowed)) {
    if ($imageError === 0) {
      if ($imageSize < 10000000) {
        $imageDestination = '../images/'.$imageName;
        $uploadSuccess = move_uploaded_file($imageTmpName, $imageDestination);
        if ($uploadSuccess) {
          $title = $_POST['title'];
          $text = $_POST['text'];
          if (isset($_POST['done'])) {
            $done = true;
          }
          $sql = "INSERT INTO home (title, image, text, done) VALUES ('$title', '$imageName', '$text', '$done')";
          $valid = mysqli_query($db, $sql);

          if ($valid) {
            $informations['success'] = "
            <div class='alert alert-success center'>Vos informations ont bien été inscrit dans la base de donnée et l\'image uploadé dans le dossier</div>\n
            <br />
            <a class='btn btn-success' href='home.php'>Retour à la liste</a>";
          }

        } else {
          echo "Une erreur est survenue!";
        }
      } else {
        echo "Votre image est trop volumineuse!";
      }
    } else {
      echo "Une erreur est survenue lors du téléchargement!";
    }
  } else {
    echo "Votre fichier n'est pas au format image souhaité!";
  }
}
?>
<div class="container-fluid">
  <?php
  if (isset($informations['success'])) {
    echo $informations['success'];
  } ?>
</div>

<?php
include('../include/footer.php');
?>
