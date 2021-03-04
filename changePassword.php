<?php

    use PHPMailer\PHPMailer\PHPMailer;
    //require_once('./bd/connecta_db.php');
    require 'vendor/autoload.php';
    require_once('register.php');
    $mail = new PHPMailer();

    try{
        $mail->IsSMTP();

        //Configuració del servidor de Correu
        //Modificar a 0 per eliminar msg error
        $mail->SMTPDebug = 2;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        
        //Credencials del compte GMAIL
        $mail->Username = 'inmanolimaginest@gmail.com';
        $mail->Password = 'Educem00.';
    
        $mail->Timeout=30;
        //Dades del correu electrònic
        $mail->SetFrom('info@imaginest.com','Imaginest');
        $mail->Subject = 'Activación de tu cuenta de ImagiNest';
        //$mail->MsgHTML('Prova');
        $mail->IsHTML(true);
        $mail->Body = 
        "<h1>Activa tu cuenta!</h1>
        <p>Para cambiar la contraseña de tu cuenta:<a href='http://localhost/ImagiNest/changePasswordHtml.php?forgotPasswordCode=$forgotPasswCode&email=$email'>Haz click aquí</a></p>
        <h2>Imaginest</h2>
        "
        ;
        //$mail->AltBody = 'Cambio de la contraseña de tu cuenta de ImagiNest';
        //$mail->addAttachment("fitxer.pdf");
    
        //Destinatari
        $address = $email;
        $mail->AddAddress($address);
    
        $mail->Send();

    }catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
    