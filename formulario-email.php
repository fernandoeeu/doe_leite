<?php
    //Message Vars
    $msg = '';
    $msgClass = '';

    //check for submit
    if (filter_has_var(INPUT_POST, 'submit')){
        //Get from data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        //Check required fields
        if (!empty($email) && !empty($name) && !empty($message)) {
            //pass
            //check email
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                //Failed
                $msg = 'Por favor insira um e-mail válido!';
                $msgClass = 'alert-danger';
            } else {
                //Pass
                $toEmail = 'fernando.acouto@yahoo.com';
                $subject = 'Contact Request from ' .$name;
                $body = '<h2>Contact Request</h2>
                    <h4>Name</h4><p>' .$name. '</p>
                    <h4>Email</h4><p>' .$email. '</p>
                    <h4>Message</h4><p>' .$message. '</p>
                ';

                // Email header
                $headers = "MIME-Version: 1.0" ."\r\n";
                $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

                // Aditional Headers
                $headers .= "From: " .$name. "<" .$email. ">" . "\r\n";
                if(mail($toEmail, $subject, $body, $headers)){
                    // Email sent succefully
                    $msg = 'Seu e-mail foi enviado com sucesso! ';
                    $msgClass = 'alert-success';
                } else {
                    $msg = 'E-mail não enviado!';
                    $msgClass = 'alert-danger';
                }

            }
        } else {
            //fail
            $msg = 'Por favor preencha todos os campos!';
            $msgClass = 'alert-danger';
        }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.html">Início</a>
            </div>
        </div>
    </nav>
    <div class="container">	
        <?php if($msg): ?>
            <div class="alert <?php echo $msgClass; ?>"> <?php echo $msg ?> </div>
        <?php endif; ?>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	      <div class="form-group">
		      <label>Nome</label>
		      <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : '' ?>">
	      </div>
	      <div class="form-group">
	      	<label>Email</label>
	      	<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : '' ?>">
	      </div>
	      <div class="form-group">
	      	<label>Mensagem</label>
	      	<textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : '' ?></textarea>
	      </div>
	      <br>
	      <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
      </form>
    </div>
</body>
</html>