<?php
    //require_once('includes/config.php');

    $name = $email = $phone = $message = $success = "";
    $name_err = $email_err = $message_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //validate name
        if(empty($_POST["name"])){
            $name_err = "Please enter your name.";
        }else{
            $name = $_POST["name"];
        }

        //validate email
        if(empty($_POST["email"])){
            $email_err = "Please enter your email.";
        }else{
            $email = $_POST["email"];
        }

        $phone = $_POST["phone"];

        //validate comments
        if(empty($_POST["message"])){
            $message_err = "Please enter your comments.";
        }else{
            $message = $_POST["message"];
        }

        if(empty($name_err) &&empty($email_err) && empty($message_err)){

            require_once ('vendor/autoload.php');

                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
                ->setUsername('e6d4c5d2b22c15')
                ->setPassword('8cf4a73321c239');

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                // Create a message
                $messages = new Swift_Message();
                
                $messages->setSubject('Demo messsage using the SwiftMailer');

                $messages->setFrom(['padmavathy6.mca@gmail.com' => 'Padma']);

                $messages->setTo([$email, 'sample@domain.org' => 'recipient name']);

                $messages->setBody("We will contact you soon"."\n Thanks Admin");

                // Send the message
                if($mailer->send($messages)){
                    $success = "Thank you for contacting us!!!";
                    $name = $email = $phone = $message = "";
                } 
                else{
                    echo "Something went wrong";
                }
            }
            else{
                echo "Error";
            }
}
    

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="css/style.css" rel="stylesheet">
        <style>
            .wrapper {width: 550px; height:auto; padding:10px 10px; margin-left: 30%; background: #CAFA6F; }
            .error { color: red;}
            .success { color: green;}
        </style>
    </head>
    <body>
    <div class="wrapper">
        <h2 class="text-center">CONTACT US</h2>
        <form action="index.php" method="post">
            <div class="form-group">
                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter your name">
                <span class="error"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group">
                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter your email">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="tel" name="phone" value="<?php echo $phone; ?>" class="form-control" placeholder="Enter your contact number">
            </div>
            <div class="form-group">
                <textarea name="message" cols="20" rows="10" class="form-control" placeholder="Enter Your message here.."><?php echo $message; ?></textarea>
                <span class="error"><?php echo $message_err; ?></span>
            </div>
            <div class="form-group text-center">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                <input type="reset" name="reset" class="btn btn-secondary" value="Reset">
                <div class="success"><b><?php echo $success; ?></b></div>
            </div>
        </form>
    </div>
       
    </body>
</html>