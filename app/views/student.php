<?php

// open the $_SESSION


// check if $_GET is empty
if(empty($_GET["id"])) {
    echo "url incorrect";
    exit;
}

if(isset($_GET["id"])){
    $id = $_GET["id"];

    try {
        $q = $db->prepare("SELECT 
                        students.firstname, 
                        students.lastname, 
                        promos.name AS promo_name, 
                        campus.name AS campus_name 
                   FROM students
                   INNER JOIN promos ON students.ID_promo = promos.id
                   INNER JOIN campus ON promos.ID_campus = campus.id
                   WHERE students.id = :idStudent");

        //To bind the $id variable to the :idStudent declaration and give a type.
        $q->bindParam(":idStudent", $id);

        $q->execute();
    } catch(PDOException $e) {
        echo $e->getMessage();
        exit;
    }


    $student = $q->fetch(PDO::FETCH_ASSOC);

    if(!$student) {
        echo "This code reference $id doesn't exist in the Database. </br> <a href='./''>Go back</a>";
        die();
    }
}

    include "includes/header.php";
?>


    <h1><?= $student["firstname"] . " " . $student["lastname"] ?></h1>

    <h2>Promo: <?= $student["promo_name"]?></h2>

    <h2>Campus: <?= $student["campus_name"]?></h2>

    <?php if(isset($_SESSION["user"])): ?>
        <a class="update-link" href="update-student?id=<?php echo $_GET["id"] ?>">Update</a>
        <form method="post" action="delete-student">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Delete">
        </form>
    <?php endif;?>

    <h2><?php echo strip_tags("<h2>attention</h2>"); ?></h2>



<?php
    include "includes/footer.php";
?>