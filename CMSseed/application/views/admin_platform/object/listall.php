<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

        <title>List_All</title>

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>

    </head> 



    <body>
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>

        <div style="padding: 15px;">List all - <?php echo $object_name; ?></div>

        <div style="padding: 15px;">
            <div class="panel panel-default">
                <table class="table table-hover table-bordered">
                    <?php
                    //Header
                    echo "<thead><tr>";
                    if ($allow_edit && $allow_edit==true){
                        echo "<th></th>";
                    }
                    if ($allow_delete && $allow_delete==true){
                        echo "<th></th>";
                    }
                    foreach ($field_setting as $name => $setting) {
                        if ($setting['display'] == true) {
                            echo "<th>" . $display_field_name[$name]['value'] . "</th>";
                        }
                    }
                    if($object_name=='Salon'||$object_name=='Stylist')
                        {
                          echo "<th>facbook like</th>";
                        }
                    echo "</tr></thead>";

                    //Content
                    foreach ($query_result as $row) {
                        echo "<tr>";
                        if ($allow_edit && $allow_edit==true){
                            echo "<td><a  href='edit/" . $row->$uid_field_name . "'><span class='glyphicon glyphicon-pencil'></span></a></td>";
                        }
                        if ($allow_delete && $allow_delete==true){
                            echo "<td><a id='delete1' href='delete/" . $row->$uid_field_name . "' ><span id='delete' class='glyphicon glyphicon-remove'></span></td>";
                        }
                        foreach ($field_setting as $name => $setting) {
                            if ($setting['display'] == true) {
                                $column_value = $row->$name;
                                
                                if ($field_setting[$name]['type'] == "image") {
                                    echo "<td><img style='width:60px;' class='img-rounded' src='".$image_pre_url. $column_value . "'/></td>";
                                } else if ($field_setting[$name]['type'] == "boolean") {
                                    echo "<td>" . ($column_value == "0" ? "否" : "是") . "</td>";
                                } else {
                                    echo "<td>" . nl2br($column_value) . "</td>";
                                }
                            }
                            
                        }
                        //camille edit for facebook like
                        if($object_name=='Salon'||$object_name=='Stylist')
                        {
                             echo "<td>" . $row->facebook_like . "</td>";
                        }
//                        foreach ($row as $name => $data) {
//                            if ($field_setting[$name] && $field_setting[$name]['display'] == true) {
//                                if ($field_setting[$name]['type'] == "image") {
//                                    echo "<td><img style='width:60px;' class='img-rounded' src='" . base_url() . "/tophair_uploaded_image/img/" . $data . "'/></td>";
//                                } else if ($field_setting[$name]['type'] == "boolean") {
//                                    echo "<td>" . ($data == "0" ? "False" : "True") . "</td>";
//                                } else {
//                                    echo "<td>" . nl2br($data) . "</td>";
//                                }
//                            } else {
//                                
//                            }
//                        }
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>    
    <script>


        $(".glyphicon-remove").click(function()
        {
            $("#delete1").append("href=" + "'edit/" + ".$row->$uid_field_name."');

        });

    </script>

</html>