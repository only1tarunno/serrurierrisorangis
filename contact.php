<?php  
    session_start();
    // include 'connection.php';
    $recipient = "devismail@entreprisehouard.com";

    if($_POST) {
        $name = "";
        $email = "";
        $email_title = "URL WEBSITE";
        $comment = "";
        $mobile = "";
        $email_body = "<div>";

        // Sanitize and Validate the Inputs
        if(isset($_POST['name'])) {
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $email_body .= "<div>
                                <label><b>Nom:</b></label>&nbsp;<span>" . $name . "</span>
                            </div>";
        }

        if(isset($_POST['email'])) {
            $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($email) {
                $email_body .= "<div>
                                    <label><b>Email:</b></label>&nbsp;<span>" . $email . "</span>
                                </div>";
            } else {
                echo '<p>Email invalide</p>';
                exit;
            }
        }

        if(isset($_POST['mobile'])) {
            $mobile = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['mobile']);
            $mobile = filter_var($mobile, FILTER_SANITIZE_STRING);
            $email_body .= "<div>
                                <label><b>Téléphone:</b></label>&nbsp;<span>" . $mobile . "</span>
                            </div>";
        }

        if(isset($_POST['city'])) {
            $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
            $email_body .= "<div>
                                <label><b>Ville:</b></label>&nbsp;<span>" . $city . "</span>
                            </div>";
        }

        $email_body .= "<div>
                            <label><b>Mail de contact :</b></label>&nbsp;<span>" . $email_title . "</span>
                        </div>";

        if(isset($_POST['comment'])) {
            $comment = htmlspecialchars($_POST['comment']);
            $email_body .= "<div>
                                <label><b>Commentaire:</b></label>
                                <div>" . $comment . "</div>
                            </div>";
        }

        $email_body .= "</div>";

        // Set Headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: ' . $email . "\r\n"; // From email must be valid

        // Send Email
        if(mail($recipient, $email_title, $email_body, $headers)) {
            echo('<script>
                    alert("Votre message a bien été envoyé");
                    window.location.replace("index.html");
                </script>');
        } else {
            echo '<p>Une erreur s\'est produite, appelez-nous</p>';
        }

    } else {
        echo '<p>Une erreur s\'est produite, appelez-nous</p>';
    }
?>

