<?php
    $action=$_POST['hope'];
    $output;
    $return_var;
    $PATH="C:\Program Files (x86)\Java\jdk1.8.0_111\bin";
    $light_status_para="Bon";
    $passwd_MySQL="test";
?>
<html>
    <head>
        <title>Se-Heon's Smart Home Test Page</title>
    </head>
    <body>
        <?php
        if($action == 1){
            putenv("PATH=$PATH");
            $check=getenv("PATH");
            //echo $check;
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
            echo exec ("Mysmarthome.jar light",$output,$return_var);
            if($return_var==1){
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
            echo exec ("Mysmarthome.jar humidity",$output,$return_var);
            if($return_var==1){
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
            echo exec ("Mysmarthome.jar temp",$output,$return_var);
            if($return_var==1){
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