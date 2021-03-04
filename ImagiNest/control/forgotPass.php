<?php

    try
    {
        $sql = "SELECT iduser, email FROM users WHERE username = ? || email = ?";
        $query = $db->prepare($sql);
        $query->execute(array($usermail, $usermail));

        if($query){

            $passCode = hash('sha256', random_int(1, 1000));

            $sql = "UPDATE users SET resetPasswordCode = ?, resetPassword = 1, resetPasswordExpiry = now() WHERE username = ? || email = ?";
            $update = $db->prepare($sql);
            $update->execute(array($passCode, $usermail, $usermail));
    
            if($preparadaUpdate)
            {
                require_once("changePassword.php");
            }   
        }else $error = true;
    }
    