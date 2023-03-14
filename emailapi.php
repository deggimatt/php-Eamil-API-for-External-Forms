<?php
// Pre-determined email address
$to = "YOUR-EMAIL@EXAMPLE.COM";

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Retrieve email data
  $subject = isset($_POST['subject']) ? $_POST['subject'] : 'New Form Submission';

  // Initialize email message
  $email_message = '';

  // Loop through all form fields and add them to email message
  foreach ($_POST as $key => $value) {
    if ($key != 'subject') {
      $email_message .= $key . ': ' . $value . "\r\n";
    }
  }

  // Send email
  if (mail($to, $subject, $email_message)) {
    $response = array(
      "status" => "success",
      "message" => "Email sent successfully"
    );
    http_response_code(200);
  } else {
    $response = array(
      "status" => "error",
      "message" => "Failed to send email"
    );
    http_response_code(500);
  }

  // Redirect to success page
  header("Location: HTTPS://EXAMPLE.COM/");
  exit();
} else {
  $response = array(
    "status" => "error",
    "message" => "Invalid request method"
  );
  http_response_code(405);
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
