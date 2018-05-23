<?php
    include_once('db.php');
    echo '<h1>MANAGE UNITS</h1>';
    echo '<div class="box2">';
    echo '<h2>ACCEPTED UNITS</h2>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Unit ID</th>';
    echo '<th>Condo Name</th>';
    echo '<th>Capacity</th>';
    echo '<th>Rent per Month</th>';
    echo '<th>Address</th>';
    echo '<th>Vacancy</th>';
    echo '<th>Description</th>';
    echo '<th>Representative\'s Phone Number</th>';
    echo '<th>Representative\'s Email</th>';
    echo '<th>Decline</th>';
    echo '<tr/>';

                $qry='select * from units natural join provider where post_status = "Approved";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '
                            <tr>
                            <td>'.$row['trans_id'].'</td>
                            <td>'.$row['condo_name'].'</td>
                            <td>'.$row['unit_capacity'].'</td>
                            <td>'.$row['price_per_night'].'</td>
                            <td>'.$row['unit_address'].'</td>
                             <td>'.$row['vacancy'].'</td>
                            <td>'.$row['unit_description'].'</td>
                            <td>'.$row['rep_phoneno'].'</td>
                            <td>'.$row['rep_email'].'</td>
							<td>
                            <form method="post">
                                <input class="radh" type="radio" name="DeclineUnit" value="'.$row['trans_id'].'" checked>
								<button type="submit" class="btn">DECLINE</button>
                            </form>
                            </td>';     
                        }

    echo '</table>';
    echo '</div>';

    echo '<div class="box2">';
    echo '<h2>DECLINED UNITS</h2>';
    echo '<table>';
    echo '<tr>';
    echo '<th>Unit ID</th>';
    echo '<th>Condo Name</th>';
    echo '<th>Capacity</th>';
    echo '<th>Rent per Month</th>';
    echo '<th>Address</th>';
    echo '<th>Vacancy</th>';
    echo '<th>Description</th>';
    echo '<th>Representative\'s Phone Number</th>';
    echo '<th>Representative\'s Email</th>';
    echo '<th>Decline</th>';
    echo '<tr/>';

                $qry='select * from units natural join provider where post_status = "Declined";';
                        $result=mysqli_query($con,$qry);
                        while($row = mysqli_fetch_array($result)){
                            echo '
                            <tr>
                            <td>'.$row['trans_id'].'</td>
                            <td>'.$row['condo_name'].'</td>
                            <td>'.$row['unit_capacity'].'</td>
                            <td>'.$row['price_per_night'].'</td>
                            <td>'.$row['unit_address'].'</td>
                            <td>'.$row['vacancy'].'</td>
                            <td>'.$row['unit_description'].'</td>
                            <td>'.$row['rep_phoneno'].'</td>
                            <td>'.$row['rep_email'].'</td>
							<td>
                            <form method="post">
                                <input class="radh" type="radio" name="AcceptUnit" value="'.$row['trans_id'].'" checked>
								<button type="submit" class="btn">APPROVE</button>
                            </form>
                            </td>';     
                        }

    echo '</table>';
    echo '</div>';
?>
