<?php

    $user = filter_input(INPUT_POST,'user');
    $email = filter_input(INPUT_POST,'email');
    $firstname = filter_input(INPUT_POST,'firstname');
    $lastname = filter_input(INPUT_POST,'lastname');
    if(filter_input(INPUT_POST,'pass') != filter_input(INPUT_POST,'passVery')) $errorPass = true;
    else
    {
        try{
            $sql = "SELECT iduser, email FROM users WHERE email = '$mail' or username = '$user'";
            $exis = $db->query($sql);
            $res = $exis->fetch();

            if($res){
                $error = true;
            }else{
                $passHash = password_hash(filter_input(INPUT_POST,'pass'), PASSWORD_DEFAULT);
                $active = 0;
                $activationCode = hash('sha256', random_int(1, 1000));
                $sql = "INSERT INTO users (email, username, password, firstName, lastName,  active, activationCode) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
                $insert = $db->prepare($sql);
                $insert->execute(array($email, $user, $pass, $firstname, $lastname, $active, $activationCode)); 
    
                if(!$insert)
                {
                    echo "<script> alert('No se ha podido insertar este usuario'); </script>";
                }else $valid = true;

            }

        }catch(PDOException $e){
            echo 'Error amb la BDs: ' . $e->getMessage();
        }
        
    }
    