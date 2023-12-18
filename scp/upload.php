<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signatureData'])) {
    // Get the signature name
    $name = $_POST['signature_name'];

    // Get the signature data as a base64-encoded string
    $signature_data = $_POST['signatureData'];

    // Extract the base64-encoded data from the data URL
    $encoded_data = explode(',', $signature_data)[1];

    // Decode the base64 data
    $decoded_data = base64_decode($encoded_data);

    // Create an 'upload1' folder if it doesn't exist
    $uploadFolder = 'upload1/';
    if (!file_exists($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    // Generate a unique filename for the signature image
    $dateTime = date("YmdHis");
    $filename = $uploadFolder . $name . '_' . $dateTime . '.png';

    // Save the decoded data to the file
    if (file_put_contents($filename, $decoded_data) !== false) {
        echo "Image uploaded successfully!";
    } else {
        echo "Error uploading image: " . error_get_last()['message'];
    }
} else {
    echo "Form not submitted or signatureData not provided.";
}

?>