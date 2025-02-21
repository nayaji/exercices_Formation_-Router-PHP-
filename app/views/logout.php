<?php


// delete session variable
unset($_SESSION["user"]);

header("location: ./");