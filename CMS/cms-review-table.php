<?php
    include '../config.php';
        if (isset($_GET['typeOfService'])){
            $type=$_GET['typeOfService'];
            if($type==1){
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
                $query="SELECT * from review where ServiceType=?";
                $stmt=$conn->prepare($query);
                if(!$stmt){
                    return false;
                }
                $stmt->bind_param("i", $type);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
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
                echo'
            </tbody>
        ';
            }
            else{
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
                $query="SELECT * from review where ServiceType=?";
                $stmt=$conn->prepare($query);
                if(!$stmt){
                    return false;
                }
                $stmt->bind_param("i", $type);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
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
                echo'
            </tbody>
        ';
            }
        }