<?php

    require_once("changePasswordHtml.php");

    $sql = "UPDATE users SET passHash = ?, resetPass = 0, resetPassCode = NULL, resetPassExpiry = now() WHERE username = ? or email = ?";
    $update = $db->prepare($sql);
    $update->execute(array(password_hash($pass, PASSWORD_DEFAULT)), $usermail, $usermail);

    if($update)
    {
        header("Location: index.php");
        exit;
    }