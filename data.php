<?php


$servername = "localhost";
$username = "root";
$password = "root";


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

    $taskName = $_POST['taskName'];
    $taskDate = $_POST['taskDate'];
    $taskType = $_POST['taskType'];
    $queryType = $_POST['queryType'];

    if ($queryType == 'select')
    {
            try {

               
                $conn = new PDO("mysql:host=$servername;dbname=TasksDB", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                $sql = "SELECT * FROM Tasks WHERE TaskDateTime = '$taskDate'";

                $result = $conn->prepare($sql);


                $colCount = $result->columnCount();
                $result->execute();

                $colCount = $result->columnCount();
                $taskListString = '';
                while($row = $result->fetch(PDO::FETCH_ASSOC))
                {
                    $taskListString .= "<li class=\"list-group-item\">".$row['TaskName']."</li>";
                }
            
                echo $taskListString;
                 
                
                  
                
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }


        $conn = null;

    }
  
    else
    {
        try {
                $conn = new PDO("mysql:host=$servername;dbname=TasksDB", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              
                $sql = "INSERT INTO Tasks (TaskDateTime, TaskName, TaskType) VALUES ('$taskDate','$taskName', '$taskType')";
                $conn->exec($sql);
                echo $taskDate;
               // echo "New Record Created Successfully"; 
            }
        catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }
    }

}

else if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    // $dateToQueryTasks = $_GET['dateToQueryTasks'];
    // //$listId = $_GET['listId'];

    // try {
    //         $conn = new PDO("mysql:host=$servername;dbname=TasksDB", $username, $password);
    //         // set the PDO error mode to exception
    //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          
    //         $sql = "SELECT FROM Tasks (TaskDateTime, TaskName, TaskType) WHERE TaskDateTime = '$dateToQueryTasks'";
    //         $result = $conn->query($sql);

    //         var taskListString = "";
    //         foreach ($result as $row) {

    //             "<li class=\"list-group-item\">"+task+"</li>";
    //             taskListString .= "<li class=\"list-group-item\">"+$row['TaskName']+"</li>";
    //         }

    //         echo taskListString;

    //     }
    // catch(PDOException $e)
    //     {
    //         echo "Connection failed: " . $e->getMessage();
    //     }
}

?>