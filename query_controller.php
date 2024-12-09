<?php
session_start();

require_once './Database.php';

//inserting student data to datab 
if(isset($_POST['query_button'])) {
    //get and assign the query in query variable to be executed
    $query = $_POST['query'];

    // Save the query to the session temporarily
    $_SESSION['query'] = $query;

    try {
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['notify_success'] = 'Query executed successfully. Rows affected: ' . $stmt->rowCount();
            $_SESSION['query'] = '';
        } else {
            $_SESSION['notify_success'] = 'Query executed successfully, but no rows were affected.';
            $_SESSION['query'] = '';
        }
    }
    catch (Exception $ex) {
         // Handle PDO exceptions (e.g., syntax errors, invalid SQL)
         $_SESSION['notify_error'] = 'Error executing query: ' .htmlspecialchars($ex->getMessage());
    }
    header('Location: index.php');
    exit();
}
?>