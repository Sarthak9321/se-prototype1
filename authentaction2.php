<?php

// Check if the form has been submitted
if (isset($_POST['Emailid']) && isset($_POST['password'])) {

    // Sanitize the form data
    $Emailid = filter_input(INPUT_POST, 'Emailid', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Check if the user exists in the database
    $db = mysqli_connect('localhost',"root",'',"sedatabase");
    $sql = "SELECT * FROM users1 WHERE Emailid='$Emailid' AND userpassword='$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 1) {
        // The user exists
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if($role =="Client"){
        header('Location: clientspage.html');
exit;
        }
        else{
        header('Location: workerspage.html');
exit;
        }
    } else {
        // The user does not exist
        echo 'Invalid email address or password.';
    }

} else {
    // The form has not been submitted
    echo 'Please fill out the form and click the "Login" button.';
}

?>
