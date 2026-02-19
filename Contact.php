<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    
    $errors = array();
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    if (empty($errors)) {
        
        $to = "itaivera22@gmail.com";
        $subject = "New Contact Form Message";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";
        
        if (mail($to, $subject, $body, $headers)) {
            echo "<script>alert('Thank you! Your message has been sent.'); window.location.href='contact.html';</script>";
        } else {
            echo "<script>alert('Sorry, there was a problem.'); window.location.href='contact.html';</script>";
        }
    } else {
        $error_msg = implode("\\n", $errors);
        echo "<script>alert('$error_msg'); window.location.href='contact.html';</script>";
    }
} else {
    header("Location: contact.html");
    exit();
}
?>