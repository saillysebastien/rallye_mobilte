<?php

include('../include/header.php');
require('../../../config/connect.php');

$informations =[];
$errors = [];
$valid = true;

$title = '';
$image = '';
$number_street = null;
$street = '';
$postal_code = null;
$city = '';
$contact = '';
$phone = null;
$mail = '';
$web = '';
$done = false;

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
  $id = $_GET['id'];

  $sql = sprintf("SELECT * FROM formations WHERE id =%s", $_GET['id']);
  $result = $db->query($sql);
  $infos = $result->fetch_assoc();

  $title = $infos['title'];
  $image = $infos['image'];
  $number_street = $infos['number_street'];
  $street = $infos['street'];
  $postal_code = $infos['postal_code'];
  $city = $infos['city'];
  $contact = $infos['contact'];
  $mail = $infos['mail'];
  $web = $infos['web'];

  if(!empty($phone) && $phone !== "N/C") {
    $phone = $infos['phone'];
  } else {
    $phone = "N/C";
  }
} else {
  $valid = false;
  $errors['id'] = "<div class='alert alert-danger text-center' role='alert'>L'identifiant de l'organisme de formation doit être spécifié !!!";
}

if ($_POST) {
  if (isset($_POST['id']) && !empty(trim($_POST['id']))) {
    $id2 = $_POST['id'];
  } else {
    $valid = false;
    $errors['id_post'] = "<div class='alert alert-danger text-center role='alert''>Vous devez remplir l'id !!!</div>";
  }

  if (isset($_POST['title']) && !empty(trim($_POST['title']))) {
    $title = $_POST['title'];
  } else {
    $valid = false;
    $title = "<div class='alert alert-danger text-center role='alert''>Vous devez donner un nom à l'organisme de formation !!!</div>";
  }

  if (isset($_POST['number_street']) && !empty(trim($_POST['number_street']))) {
    $number_street = $_POST['number_street'];
  } else {
    $number_street = null;
  }

  if (isset($_POST['street']) && !empty(trim($_POST['street']))) {
    $street = $_POST['street'];
  } else {
    $valid = false;
    $errors['street'] = "<div class='alert alert-danger text-center' role='alert'>Vous devez indiquer l'adresse !!!</div>";
  }

  if (isset($_POST['postal_code']) && !empty(trim($_POST['postal_code']))) {
    $postal_code= $_POST['postal_code'];
  } else {
    $valid = false;
    $errors['postal_code'] = "<div class='alert alert-danger text-center' role='alert'>Vous devez indiquer le code postal !!!</div>";
  }

  if (isset($_POST['city']) && !empty(trim($_POST['city']))) {
    $city = $_POST['city'];
  } else {
    $valid = false;
    $errors['city'] = "<div class='alert alert-danger text-center' role='alert'>Vous devez indiquer la ville !!!</div>";
  }

  if (isset($_POST['image2']) && !empty(trim($_POST['image2']))) {
    $image = $_POST['image2'];
  } else {
    $valid = false;
    $errors['image'] = "<div class='alert alert-danger text-center' role='alert'>Vous ne pouvez pas enlever l'image !!!</div>";
  }

  if (isset($_POST['contact']) && !empty(trim($_POST['contact']))) {
    $contact = $_POST['contact'];
  } else {
    $contact = "N/C";
  }

  if (isset($_POST['phone']) && !empty(trim($_POST['phone']))) {
    $phone = $_POST['phone'];
  } else {
    $phone = "N/C";
  }

  if (isset($_POST['mail']) && !empty(trim($_POST['mail']))) {
    $mail = $_POST['mail'];
  } else {
    $mail = "N/C";
  }

  if (isset($_POST['web']) && !empty(trim($_POST['web']))) {
    $web = $_POST['web'];
  } else {
    $web = "N/C";
  }

  if (isset($_POST['done'])) {
    $done = true;
  }

  if ($valid) {
    try {
      $sql = sprintf("UPDATE formations SET id='$id2', title='$title', image='$image', number_street='$number_street', street='$street', postal_code='$postal_code', city='$city', contact='$contact', phone='$phone', mail='$mail', web='$web', done='$done' WHERE id='%s'", $_GET['id']);
      $valid_sql = mysqli_query($db, $sql);

    } catch (Exception $e) {
      header('Location: error500.html', true, 302);
      exit();
    }
    if ($valid_sql) {
      $informations['success'] = "<div class='alert alert-dark text-center' role='alert'>Organisme de formation $title modifiée <br /><br /><a class='btn btn-success' href='formations.php'>Retour à la liste des organismes de formations</a></div>\n";
    }
  }
}
?>

<div class="container-fluid">
  <?php

  if (isset($informations['success'])) {
    echo $informations['success'];
  }

  if (isset($errors['id'])) {
    echo $errors['id'];
  }

  if (isset($errors['id_post'])) {
    echo $errors['id_post'];
  }

  if (isset($errors['title'])) {
    echo $errors['title'];
  }

  if (isset($errors['street'])) {
    echo $errors['street'];
  }

  if (isset($errors['postal_code'])) {
    echo $errors['postal_code'];
  }

  if (isset($errors['city'])) {
    echo $errors['city'];
  }

  if (isset($errors['domain_activity'])) {
    echo $errors['domain_activity'];
  }

  if (isset($errors['image'])) {
    echo $errors['image'];
  }

  ?>
  <div class="row justify-content-center">
    <div class="col-12">

      <legend>Modification d'une fiche FORMATION</legend>
      <form method="post" enctype="multipart/form-data">

        <div class="row">
          <div class="form-group col-6">
            <label class="col-4" for="id">Identifiant de la formation</label>
            <input type="numeric" class="col-6" name="id" value="<?= htmlentities($id) ?>" required />
          </div>

          <div class="form-group col-6">
            <label class="col-4" for="title">Nom de la formation</label>
            <input class="col-6" type="text" name="title" value="<?= htmlentities($title) ?>" required />
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label class="col-4" for="number_street">Numéro de l'adresse</label>
            <input class="col-6" type="numeric" name="number_street" value="<?= htmlentities($number_street) ?>" />
          </div>

          <div class="form-group col-6">
            <label class="col-4" for="street">Adresse de la formation</label>
            <input class="col-6" type="text" name="street" value="<?= htmlentities($street) ?>" placeholder="exemple: avenue Jean Jaurès"required />
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label class="col-4" for="postal_code">Code postal de la ville</label>
            <input class="col-6" type="numeric" name="postal_code" value="<?= htmlentities($postal_code) ?>" required />
          </div>

          <div class="form-group col-6">
            <label class="col-4" for="city">Ville de la formation</label>
            <input class="col-6" type="text" name="city" value="<?= htmlentities($city) ?>" required />
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label class="col-4" for="contact">Contact</label>
            <input class="col-6" type="text" name="contact" value="<?= htmlentities($contact) ?>" placeholder="exemple: Mr Dupont Claude" />
          </div>
          <div class="form-group col-6">
            <label class="col-4" for="phone">Numéro de téléphone</label>
            <input class="col-6" type="numeric" name="phone" maxlength="10" value="<?= htmlentities($phone) ?>" placeholder="exemple: 0321281510" />
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label class="col-4" for="mail">Adresse mail</label>
            <input class="col-6" type="mail" name="mail" value="<?= htmlentities($mail) ?>" />
          </div>

          <div class="form-group col-6">
            <label class="col-4" for="web">Site web</label>
            <input class="col-6" type="text" name="web" value="<?= htmlentities($web) ?>" placeholder="exemple: " />
          </div>
        </div>

        <div class="row">
          <div class="form-group col-6">
            <label class="col-4" for="text">Nom de l'image</label>
            <input class="col-6" type="text" name="image2" id="text" value="<?= htmlentities($image) ?>"  />
          </div>

          <div class="form-check col-6">
            <label class="form-check-label col-12">
              <input type="checkbox" class="form-check-input col-3" name="done" value="1" <?php if ($done) { echo 'checked'; } ?> />
              Cochez ici si vous voulez que cette formation soit affichée!
            </label>
          </div>
        </div>

        <button type="submit" name="update" class="btn btn-primary">Valider</button>

      </form>
    </div>
  </div>
</div>

<?php
include('../include/footer.php');
?>