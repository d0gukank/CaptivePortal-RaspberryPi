                 <?php
                      $q = $conn->query("SELECT * FROM domain_rule ");
                      $q->execute();
                      $r = $q->fetchAll(PDO::FETCH_ASSOC);
                           foreach( $r as $row ){
    echo '<tr>';
    echo '<td>'.$row['id'].'</td>';
    echo '<td>'.$row['block'].'</td>';
    echo '<td>'.$row['rule'].'</td>';
    echo '<td>'.$row['time'].'</td>';
    echo '<td>x</td>';
    echo '</tr>';
                           }
                          ?>
