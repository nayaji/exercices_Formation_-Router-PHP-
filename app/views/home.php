<?php



// open the $_SESSION

try {
    $statement = $db->prepare("SELECT * FROM students");

    $statement->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

$students = $statement->fetchAll(PDO::FETCH_ASSOC);

	include "includes/header.php";

?>


<main>
		<h1>Becode Admin</h1>
    <ol>
        <?php
            //display the datas
            foreach($students as $student) : ?>

            <li>
                <a href="student?id=<?php echo $student["ID"] ?>">
                    <h3><?= $student["firstname"] . " " . $student["lastname"];?></h3>
                </a>
            </li>

        <?php
            endforeach;
        ?>
    </ol>

</main>

<?php
    include "includes/footer.php";
?>