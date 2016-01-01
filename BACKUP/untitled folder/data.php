<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $taskName = $_POST['taskName'];
    $taskDate = $_POST['taskDate'];
    $taskType = $_POST['taskType'];

    $servername = "localhost";
    $username = "root";
    $password = "root";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=TasksDB", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
        $sql = "INSERT INTO Tasks (TaskDateTime, TaskName, TaskType) VALUES ('$taskDate','$taskName', '$taskType')";
        $conn->exec($sql);
        echo "New Record Created Successfully"; 
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

}

else if ($_SERVER["REQUEST_METHOD"] == "GET")
{

    

}
?>