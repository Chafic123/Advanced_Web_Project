<?php
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
                if(!$stmt){
                    return false;
                }
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
                if(!$stmt){
                    return false;
                }
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

    if (isset($_GET['type-of-service'])){
        $type=$_GET['type-of-service'];

        if($type==1){    
            if(isset($_GET['rating-categories']) && isset($_GET['orderOfRating'])){
                $cat=$_GET['rating-categories'];
                $order=$_GET['orderOfRating']; 
                if($cat==0){      
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by ((Field1+Field2+Field3+Field4)/4) DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                    else{
                        $query.="order by ((Field1+Field2+Field3+Field4)/4) ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }   
                }
                else if($cat==1){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field1 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                    else{
                        $query.="order by Field1 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                }
                else if($cat==2){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field2 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                    else{
                        $query.="order by Field2 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                }
                else if($cat==3){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field3 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                    else{
                        $query.="order by Field3 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                }
                else if($cat==4){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field4 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                    else{
                        $query.="order by Field4 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        InHouseTable($result);
                    }
                }
            }
            else{
                $query="SELECT * from review where ServiceType=?";
                $stmt=$conn->prepare($query);
                if(!$stmt){
                    return false;
                }
                $stmt->bind_param("i", $type);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                InHouseTable($result);
            }
        }

        else{
            if(isset($_GET['rating-categories']) && isset($_GET['orderOfRating'])){
                $cat=$_GET['rating-categories'];
                $order=$_GET['orderOfRating']; 
                if($cat==0){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by ((Field1+Field2+Field3+Field4)/4) DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                    else{
                        $query.="order by ((Field1+Field2+Field3+Field4)/4) ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                }
                else if($cat==1){ 
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field1 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                    else{
                        $query.="order by Field1 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                }
                else if($cat==2){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field2 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                    else{
                        $query.="order by Field2 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                }
                else if($cat==3){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field3 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                    else{
                        $query.="order by Field3 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                }
                else if($cat==4){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field4 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                    else{
                        $query.="order by Field4 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                }
                else if($cat==5){
                    $query="SELECT * from review where ServiceType=? ";
                    if($order==1){
                        $query.="order by Field5 DESC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                    else{
                        $query.="order by Field5 ASC";
                        $stmt=$conn->prepare($query);
                        if(!$stmt){
                            return false;
                        }
                        $stmt->bind_param("i", $type);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        DeliveryTable($result);
                    }
                }
            }
            else{
                $query="SELECT * from review where ServiceType=?";
                $stmt=$conn->prepare($query);
                if(!$stmt){
                    return false;
                }
                $stmt->bind_param("i", $type);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                DeliveryTable($result);
            }
        }
    }
    else{
        echo"No Reviews!";
    }