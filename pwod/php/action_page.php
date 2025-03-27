<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $fname = htmlspecialchars($_POST['firstname']);
    $lname = htmlspecialchars($_POST['lastname']);
    $subject = htmlspecialchars($_POST['subject']);

    // Check if an email was provided and sanitize it
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $user_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    } else {
        $user_email = "no-reply@yourwebsite.com"; // Fallback if no email is provided
    }

    // Email where you want to receive the message
    $to = "reltronicdeffender@gmail.com";  // Replace with your real email
    $subject_email = "New Contact Form Submission";

    // Construct the message
    $message = "Name: $fname $lname\n";
    $message .= "Email: $user_email\n\n";
    $message .= "Message:\n$subject";

    // Set headers
    $headers = "From: no-reply@yourwebsite.com\r\n";
    $headers .= "Reply-To: $user_email\r\n"; // This allows you to reply directly to the sender
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject_email, $message, $headers)) {
        echo "<div style='border:1px solid #ccc; padding:20px; width:50%; margin:auto; background-color:#f2f2f2; text-align:center;'>
                <h2>Thank you, $fname!</h2>
                <p>Your message has been sent successfully.</p>
              </div>";
    } else {
        echo "<div style='border:1px solid #ccc; padding:20px; width:50%; margin:auto; background-color:#f2f2f2; text-align:center;'>
                <h2>Sorry!</h2>
                <p>There was an error sending your message. Please try again later.</p>
              </div>";
    }
} else {
    echo "<div style='border:1px solid #ccc; padding:20px; width:50%; margin:auto; background-color:#f2f2f2; text-align:center;'>
            <h2>Invalid Submission</h2>
            <p>Please fill out the form properly.</p>
          </div>";
}
?>