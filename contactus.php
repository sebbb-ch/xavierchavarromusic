<?php
/* Set e-mail recipient */
$myemail  = "alvesj@c2itdigital.com";

/* Check all form inputs using check_input function */
$subject  = check_input($_POST['subject'], "Please selection your subject matter");
$yourname = check_input($_POST['yourname'], "Please enter your name");
$email    = check_input($_POST['email'], "Please enter a valid email address");
$phone    = check_input($_POST['phone'], "Please enter a contact number");
$message  = check_input($_POST['message'], "Please enter your message");
/* $website  = check_input($_POST['website']); */
/* $likeit   = check_input($_POST['likeit']); */
/* $how_find = check_input($_POST['how']); */

/* If e-mail is not valid show error message */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email))
{
    show_error("E-mail address not valid");
}

/* If URL is not valid set $website to empty */
if (!preg_match("/^(https?:\/\/+[\w\-]+\.[\w\-]+)/i", $website))
{
    $website = '';
}

/* Let's prepare the message for the e-mail */
$message = "Hello!

The Contact Us form has been submitted by:

Name: $yourname
Subject: $subject
E-mail: $email
Phone: $phone

Message:
$message

End of message
";

/* Send the message using mail() function */
mail($myemail, $subject, $message);

/* Redirect visitor to the thank you page */
header('Location: thanks.html');
exit();

/* Functions we used */
function check_input($data, $problem='')
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($problem && strlen($data) == 0)
    {
        show_error($problem);
    }
    return $data;
}

function show_error($myError)
{
?>
    <html>
    <body>

    <b>Please correct the following error:</b><br />
    <?php echo $myError; ?>

    </body>
    </html>
<?php
exit();
}
?>