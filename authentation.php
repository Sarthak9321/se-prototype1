<?php

// Check if the form has been submitted
if (isset($_POST['Emailid']) && isset($_POST['password']) && isset($_POST['tel']) && isset($_POST['usertype'])) {

    // Sanitize the form data
    $Emailid = filter_input(INPUT_POST, 'Emailid', FILTER_SANITIZE_EMAIL);
    $userpassword = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $number = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
    $role = filter_input(INPUT_POST, 'usertype', FILTER_SANITIZE_STRING);

    // Check if the usertype is valid
    if ($role != 'Client' && $role != 'Worker') {
        echo 'Invalid usertype.';
        exit;
    }

   

    // Connect to the database
    $db = mysqli_connect('localhost',"root",'',"sedatabase");
    // Insert the user data into the database
    $sql = "INSERT INTO users1 (Emailid, userpassword, number, role) VALUES ('$Emailid', '$userpassword', '$number', '$role')";
    $db->query($sql);

    if($role =='Client'){
        header('Location: clientspage.html');
exit;
    }
} else {
    // The form has not been submitted
    echo 'Please fill out the form and click the "Register" button.';
}

?>
