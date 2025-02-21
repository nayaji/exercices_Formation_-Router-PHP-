<?php

//require_once "connexion.php";

// open the $_SESSION


if(!empty($_POST) OR !empty($_GET["id"])) {
    // 1. Check all the inputs exist
    // 2. We check also if the $_POST are not empty because we load the page, the form is empty
    if(isset($_GET['id'])) {
        $id_student = (int) $_GET["id"];

        $q = $db->prepare("SELECT * FROM students WHERE id = :id");
        $q->bindParam(":id", $id_student, PDO::PARAM_INT);
        $q->execute();
        $student = $q->fetch();

        if(isset($_POST["firstname"]) OR isset($_POST["lastname"]) OR isset($_POST["promo"])) {

          $firstname = strip_tags($_POST["firstname"]);
          $lastname = strip_tags($_POST["lastname"]);
          $id_promo = (int)$_POST["promo"];

          if ($firstname === "") {
            $firstname = $student["firstname"];
          }
          if ($lastname === "") {
            $lastname = $student["lastname"];
          }

          //SQL part
          $q = $db->prepare("UPDATE students SET firstname= :firstname, lastname= :lastname, ID_promo= :id_promo WHERE ID=$id_student");

          // bindParam() accepte uniquement une variable qui est interprétée au moment de l'execute()
          $q->bindParam(":firstname", $firstname, PDO::PARAM_STR);
          $q->bindParam(":lastname", $lastname, PDO::PARAM_STR);
          $q->bindParam(":id_promo", $id_promo, PDO::PARAM_INT);

          // exexute return a boolean
          if (!$q->execute()) {
            die("form not sent to the db");
          }

          header("location: ./student?id=$_GET[id]");
          exit;
        }
    }
}

if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $q = $db->prepare("SELECT * FROM students WHERE id = :id");
    $q->bindParam(":id", $id, PDO::PARAM_INT);
    $q->execute();
    $student = $q->fetch();
}

// Request for promos
$q_promo = $db->prepare("SELECT * FROM promos");
$q_promo->execute();
$promos = $q_promo->fetchAll(PDO::FETCH_ASSOC);

// HTML
include "includes/header.php";

?>


<h1>Update Student</h1>

    <form method="post" action="">
        <div>
            <label for="firstname">Firstname :</label>
            <input type="text" name="firstname" placeholder="<?= $student["firstname"] ?>">
        </div>
        <div>
            <label for="lastname">Lastname :</label>
            <input type="text" name="lastname" placeholder="<?= $student["lastname"] ?>">
        </div>
        <div>
            <label for="promo">Promo :</label>
            <select name="promo">
                <?php foreach ($promos as $promo) :
                    if($student["ID_promo"] === $promo["ID"]) : ?>
                        <option selected value="<?= $student["ID_promo"] ?>"><?= $promo["name"] ?></option>
                        <?php else : ?>
                        <option value="<?= $promo["ID"] ?>"><?= $promo["name"] ?></option>
                <?php
                    endif;
                endforeach;?>
            </select>
        </div>
        <button type="submit">Update Student</button>
    </form>



<?php
    include "includes/footer.php";
?>
