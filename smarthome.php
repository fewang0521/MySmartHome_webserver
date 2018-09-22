<?php
    $action=$_POST['hope'];
    $output;
    $return_var;
    $success_run="Success to run jar\n";
    $PATH_JAVA='"C:\Program Files (x86)\Java\jre1.8.0_181\bin\java" -jar';
    $PATH_JAR='C:\Apache24\htdocs\Mysmarthome.jar';
    $light_status_para="Bon";
    $passwd_MySQL="test";
?>
<html>
    <head>
        <title>Se-Heon's Smart Home Test Page</title>
    </head>
    <body>
        <?php
        //Turn on light action, action 1
        if($action == 1){
            echo '<p>You turn on the computer</p>';
            //exec ("java",$output,$return_var);
            //exec ("java -jar C:\Users\fewan\Desktop\On.jar",$output,$return_var);
            echo exec ("On.jar",$output,$return_var);
        }
        else if($action == 2){
            echo '<p>You turn off the computer</p>';
            echo exec ("Off.jar",$output,$return_var);
        }
        else if($action == 3){
            $parameter="light";
            //$command=$PATH_JAVA." ".$PATH_JAR." ".$parameter;
            $command=$PATH_JAVA." ".$PATH_JAR." ".$parameter;
            $return_var= shell_exec ($command);
            //$return_var= shell_exec ('"C:\Program Files (x86)\Java\jre1.8.0_181\bin\java" -jar C:\Apache24\htdocs\Mysmarthome.jar light');
            if(!strcmp($return_var,$success_run)){
            $db= new mysqli('localhost','root',$passwd_MySQL,'java_test');
            if (mysqli_connect_errno()){
                echo '<p> Error</p>';
                exit;
            }

            $query = "SELECT * FROM sensor_values WHERE parameter = ?";

            $stmt = $db->prepare($query);
            $stmt->bind_param('s',$parameter);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($parameter,$value,$status);

            while($stmt->fetch()){
                echo "<p> Paramter: ".$parameter." ";
                echo "<p> values: ".$value." ";
                echo "<p> status: ".$status." ";
            }
            $stmt->free_result();
            $db->close();
              
    
            }
            else{
                echo "Error to exeute jar";
                }
            }
        else if($action == 4){
            $parameter="humidity";
            $command=$PATH_JAVA." ".$PATH_JAR." ".$parameter;
            $return_var= shell_exec ($command);
            if(!strcmp($return_var,$success_run)){
            $db= new mysqli('localhost','root',$passwd_MySQL,'java_test');
            if (mysqli_connect_errno()){
                echo '<p> Error</p>';
                exit;
            }

            $query = "SELECT * FROM sensor_values WHERE parameter = ?";

            $stmt = $db->prepare($query);
            $stmt->bind_param('s',$parameter);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($parameter,$value,$status);

            while($stmt->fetch()){
                echo "<p> Paramter: ".$parameter." ";
                echo "<p> values: ".$value."%";
                echo "<p> status: ".$status."";
            }
            $stmt->free_result();
            $db->close();
              
    
            }
            else{
                echo "Error to exeute jar";
                }
            }
        else if($action == 5){
            $parameter="temp";
            $command=$PATH_JAVA." ".$PATH_JAR." ".$parameter;
            $return_var= shell_exec ($command);
            if(!strcmp($return_var,$success_run)){
            $db= new mysqli('localhost','root',$passwd_MySQL,'java_test');
            if (mysqli_connect_errno()){
                echo '<p> Error</p>';
                exit;
            }

            $query = "SELECT * FROM sensor_values WHERE parameter = ?";

            $stmt = $db->prepare($query);
            $stmt->bind_param('s',$parameter);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($parameter,$value,$status);

            while($stmt->fetch()){
                echo "<p> Paramter: ".$parameter." ";
                echo "<p> values: ".$value."℃";
                echo "<p> status: ".$status."";
            }
            $stmt->free_result();
            $db->close();
              
    
            }
            else{
                echo "Error to exeute jar";
                }
            }    
        ?>
    </body>
</html>