
<?php
// Only accept form submissions using POST.
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Please submit your enquiry using the contact form.");
}

// Collect and validate the form fields.
$name = trim($_POST["name"] ?? "");
$surname = trim($_POST["surname"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$service = trim($_POST["service"] ?? "");
$message = trim($_POST["message"] ?? "");

// Check that all required fields have been completed.
if (
    $name === "" ||
    $surname === "" ||
    $email === "" ||
    $phone === "" ||
    $service === "" ||
    $message === ""
) {
    exit("Please complete all required fields.");
}

// Validate the customer's email address.
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

// Prevent email header injection.
if (preg_match('/[\r\n]/', $email)) {
    exit("Invalid email address.");
}

// Business email address receiving enquiries.
$to = "ST10504584@rcconnect.edu.za";

$subject = "New Enquiry - Amped & Electrified";

// Build the email content.
$body =
    "NEW WEBSITE ENQUIRY\n\n" .
    "Name: " . $name . "\n" .
    "Surname: " . $surname . "\n" .
    "Email: " . $email . "\n" .
    "Phone: " . $phone . "\n" .
    "Service: " . $service . "\n\n" .
    "Message:\n" . $message . "\n";

// Use an email address belonging to your own domain
// as the sender. Replace it if necessary.
$headers = "From: website@ampedandelectrified.co.za\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send the enquiry.
if (mail($to, $subject, $body, $headers)) {
    echo "<h1>Thank you!</h1>";
    echo "<p>Your enquiry has been submitted.</p>";
    echo '<p><a href="contact.html">Return to Contact Us</a></p>';
} else {
    http_response_code(500);
    echo "<h1>Sorry</h1>";
    echo "<p>Your enquiry could not be sent. Please contact us by email or telephone.</p>";
}
?>
