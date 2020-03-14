<?php
function DisplayFirewall(){

?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><i class="fa fa-fire fa-fw"></i>Block Domain Ip Mac</div>
            <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active systemtab"><a href="#system" aria-controls="system" role="tab" data-toggle="tab">Ip Block</a></li>
                    <li role="presentation" class="active systemtab"><a href="#system" aria-controls="system" role="tab" data-toggle="tab">Domain Block</a></li>
                    <li role="presentation" class="active systemtab"><a href="#system" aria-controls="system" role="tab" data-toggle="tab">Mac Block</a></li>
                </ul><br>
                <div class="systemtabcontent tab-content">
                    <div role="tabpanel" class="tab-pane active" id="system">
                        <div class="row">
                            <div class="col-lg-6">
                                <form role="form" action="?page=firewall_conf" method="POST">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="text">Domain</label>
                                            <input type="text" class="form-control" name="domain" placeholder="example.com" />
                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-outline btn-primary" style="" />
                                </form></div>  </div><br><br>
                                <table class="table table-responsive table-striped">
             <tr>

               <th>ID</th>
               <th>Block Domain</th>
               <th>Rule</th>
               <th>Date</th>
               <th></th>
             </tr>

                          <tr>
                                         <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                        <td>x</td>
                                          <td>x</td>

                                         </tr>
<?php

                      $q = $conn->query("SELECT * FROM domain_rule");
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

              </table>







                    </div>
                    <div role="tabpanel" class="tab-pane" id="console">

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel-default -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

<?php } ?>
