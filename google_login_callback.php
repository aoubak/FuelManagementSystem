<?php
require_once 'vendor/autoload.php'; // Make sure Composer's autoload file is included

session_start();

// Replace with your own Google client credentials
$clientID = '576569956930-4qfshlhillkmag4n7i9oedi4fglf3u0j.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/FMS/google_login_callback.php';

// Create Client
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);

        // Get user info
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        $email = $google_account_info->email;
        $name = $google_account_info->name;

        // Save user info in session
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;

        // Redirect to dashboard or homepage
        header('Location: dashboard.php');
        exit;
    } else {
        echo 'Error fetching token: ' . $token['error_description'];
    }
} else {
    echo 'No code parameter provided by Google.';
}




