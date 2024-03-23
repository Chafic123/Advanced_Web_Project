<?php
if(session_status()!=2){
    session_start();
}
if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
    include '../config.php';

    function DeliveryTable($result){
        global $conn;
        echo'
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Email</th>
                <th scope="col">Delivery Time</th>
                <th scope="col">Food Quality</th>
                <th scope="col">Cleanliness</th>
                <th scope="col">Packaging</th>
                <th scope="col">Customer Service</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
        <tbody>';
        while($row=$result->fetch_assoc()){
            echo"<tr>";
            if($row["AccountNum"]==3){
                echo"<td>".$row["ReviewDate"]."</td>";
                echo"<td>".$row["GuestEmail"]."</td>";
                echo"<td>".$row["Field1"]."</td>";
                echo"<td>".$row["Field2"]."</td>";
                echo"<td>".$row["Field3"]."</td>";
                echo"<td>".$row["Field4"]."</td>";
                echo"<td>".$row["Field5"]."</td>";
                echo"<td>".$row["Message"]."</td>";
            }
            else{
                $accNum=$row["AccountNum"];
                $accEmail="SELECT Email from account where AccountNum LIKE ?";
                $stmt=$conn->prepare($accEmail);
                $stmt->bind_param("i", $accNum);
                $stmt->execute();
                $email = $stmt->get_result();
                $stmt->close();
                echo"<td>".$row["ReviewDate"]."</td>";
                echo"<td>".$email->fetch_assoc()["Email"]."</td>";
                echo"<td>".$row["Field1"]."</td>";
                echo"<td>".$row["Field2"]."</td>";
                echo"<td>".$row["Field3"]."</td>";
                echo"<td>".$row["Field4"]."</td>";
                echo"<td>".$row["Field5"]."</td>";
                echo"<td>".$row["Message"]."</td>";
            }

            echo"</tr>";
        }
        echo'</tbody>';
    }

    function InHouseTable($result){
        global $conn;
        echo'
        <thead>
            <tr>
            <th scope="col">Date</th>
                <th scope="col">Email</th>
                <th scope="col">Service</th>
                <th scope="col">Food Quality</th>
                <th scope="col">Cleanliness</th>
                <th scope="col">Atmosphere</th>
                <th scope="col">Location</th>
                <th scope="col">Message</th>
            </tr>
        </thead>
        <tbody>';
        while($row=$result->fetch_assoc()){
            echo"<tr>";
            if($row["AccountNum"]==3){
                echo"<td>".$row["ReviewDate"]."</td>";
                echo"<td>".$row["GuestEmail"]."</td>";
                echo"<td>".$row["Field1"]."</td>";
                echo"<td>".$row["Field2"]."</td>";
                echo"<td>".$row["Field3"]."</td>";
                echo"<td>".$row["Field4"]."</td>";
                echo"<td>".$row["Location"]."</td>";
                echo"<td>".$row["Message"]."</td>";
            }
            else{
                $accNum=$row["AccountNum"];
                $accEmail="SELECT Email from account where AccountNum LIKE ?";
                $stmt=$conn->prepare($accEmail);
                $stmt->bind_param("i", $accNum);
                $stmt->execute();
                $email = $stmt->get_result();
                $stmt->close();
                echo"<td>".$row["ReviewDate"]."</td>";
                echo"<td>".$email->fetch_assoc()["Email"]."</td>";
                echo"<td>".$row["Field1"]."</td>";
                echo"<td>".$row["Field2"]."</td>";
                echo"<td>".$row["Field3"]."</td>";
                echo"<td>".$row["Field4"]."</td>";
                echo"<td>".$row["Location"]."</td>";
                echo"<td>".$row["Message"]."</td>";
            }

            echo"</tr>";
        }
        echo'</tbody>';
    }

    $query="SELECT * from review where 1=1 ";

    if (isset($_POST['type-of-service'])){
        $type=$_POST['type-of-service'];
        $query.="and ServiceType=? ";
        if(isset($_POST['rating-categories'])){
                $cat=$_POST['rating-categories'];
                if($cat==0){
                    if($type==1){
                        $query.= "order by ((Field1+Field2+Field3+Field4)/4) ";
                    }
                    else{
                        $query.= "order by ((Field1+Field2+Field3+Field4+Field5)/5) ";
                    }      
                }
                else if($cat==1){
                    $query.="order by Field1";
                }
                else if($cat==2){
                    $query.="order by Field2";
                }
                else if($cat==3){
                    $query.="order by Field3";
                }
                else if($cat==4){
                    $query.="order by Field4";
                }
                else if($cat==5){
                    $query.="order by Field5";
                }
                if(isset($_POST['orderOfRating'])){
                    $order=$_POST['orderOfRating']; 
                    if($order==1){
                        $query.=" DESC";
                    }
                    else{
                        $query.=" ASC";
                    }
                }
        }
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i", $type);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($type==1){
            InHouseTable($result);
        }
        else if($type==0){
            DeliveryTable($result);
        }
        else{
            echo"No Reviews!";
        }
    }    
}else{
    header("Location: ../Home/index.php");
}