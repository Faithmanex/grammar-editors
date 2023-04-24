<?php
// Set the recipient email address
$to = "fmanekponne@gmail.com";

// Set the email subject
$subject = "New message from your website";

// Get the form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Generate a unique ID for the email
$email_id = md5(uniqid());

// Set the email headers
$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"$email_id\"\r\n";

// Set the email body
$body = "--$email_id\r\n";
$body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
$body .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
$body .= "Name: $name\r\n";
$body .= "Email: $email\r\n";
$body .= "Message:\r\n$message\r\n\r\n";

// Check if an attachment was uploaded
if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
  // Get the attachment file name and contents
  $attachment_name = $_FILES['attachment']['name'];
  $attachment_tmp_name = $_FILES['attachment']['tmp_name'];
  $attachment_contents = file_get_contents($attachment_tmp_name);

  // Add the attachment to the email
  $body .= "--$email_id\r\n";
  $body .= "Content-Type: application/octet-stream; name=\"$attachment_name\"\r\n";
  $body .= "Content-Transfer-Encoding: base64\r\n";
  $body .= "Content-Disposition: attachment; filename=\"$attachment_name\"\r\n\r\n";
  $body .= chunk_split(base64_encode($attachment_contents)) . "\r\n";
}

// Add the email footer
$body .= "--$email_id--";

// Send the email
if (mail($to, $subject, $body, $headers)) {
  echo "Message sent successfully.";
} else {
  echo "Message not sent. Please try again later.";
}
?>
