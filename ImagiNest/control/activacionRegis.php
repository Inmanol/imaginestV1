<?php

    $email = filter_input(INPUT_GET, 'email');
    $activationCode = filter_input(INPUT_GET, 'activationCode');

    try
    {
        $sql = 'SELECT iduser, email FROM users WHERE (email = ? && activationCode = ?) && active = 0';
        $query = $db->prepare($sql);
        $query->execute(array($email, $activationCode));

        if($query)
        {
            foreach ($query as $user)
            {
                $sql = 'UPDATE users SET active = 1, activationDate = now() WHERE iduser = ?';
                $update = $db->prepare($sql);
                $update->execute(array($iduser));
                $activado = true;
            }
        }
    }
    catch (PDOException $e)
    {
        echo 'Error con la BDs: ' . $e->getMessage();
    }