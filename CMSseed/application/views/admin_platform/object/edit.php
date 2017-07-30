<?php
 $this->load->helper('form');
?>
<div style="padding: 15px;">Edit - <?php echo $object_name; ?></div>


<div style="padding: 15px;">
    <div class="panel panel-default" style="padding: 15px;">
        <?php
         $attributes = array('class' => 'form-signin', 'role' => 'form');

         echo form_open_multipart('admin_platform/' . $module_name . '/update' . '/' . $uid, $attributes);

         foreach ($field_setting as $name => $data) {
             $ifvalue;
             if ($object_name == 'Salon' ) {
                 $ifvalue = $display_field_name[$name]['value'];
             } else {
                 $ifvalue='';
             }
             if ($ifvalue != '地區') {
                 if ($field_setting[$name]['display'] == true) {
                     $requiredStr = "";
                     if ($field_setting[$name]['required'] && $field_setting[$name]['required'] == true) {
                         $requiredStr = "required";
                     }
                     echo "<div class='form-group'>";
                     echo "<label for='$name' class='col-sm-2 control-label'>" . $display_field_name[$name]['value'] . "</label>";
                     echo "<div class='col-sm-10'>";

                     if ($field_setting[$name]['type'] == "checkbox") {
                         $checked = '';
                         if ($query_result[0]->$name == "1") {
                             $checked = "checked";
                         }
                         echo "<input value='1' type='" . $field_setting[$name]['type'] . "' $requiredStr $checked class='form-control' id='$name' name='$name' placeholder='Enter " . $display_field_name[$name]['value'] . "'>";
                     } else if ($field_setting[$name]['type'] == "textarea") {
                         echo "<textarea value='" . $query_result[0]->$name . "' id='$name' name='$name' class='form-control' rows='3'>" . $query_result[0]->$name . "</textarea>";
                     } else if ($field_setting[$name]['type'] == "dropdown") {
                         $data_array = $field_setting[$name]['list'];
                         echo "<select id='$name' name='$name' class='form-control'>";
                         foreach ($data_array as $option_row) {
                             $select_string = '';
                             if ($option_row->option_value == $query_result[0]->$name) {
                                 $select_string = 'selected';
                             }
                             echo "<option value='" . $option_row->option_value . "' $select_string>" . $option_row->option_name . "</option>";
                         }
                         echo "</select>";
                     } else if ($field_setting[$name]['type'] == "price_list") {

                         $json_string = $query_result[0]->$name;

                         $json_obj = json_decode($json_string);
                         $group = 6;
                         $item = 6;
                         
                         //print_r($json_obj);
                         for ($i = 0; $i < $group; $i++) {
                             $title_name = '';
                             if ($json_obj[$i]!= null) {
                                 //ca
                         //print_r($json_obj[$i][0]);
                                 $title_name = $json_obj[$i][0]->type;
                             }
                             echo "<input name='" . $name . "_" . $i . "' value='" . $title_name . "' class='form-control'></input>";
                             $itemList = null;
                             if ($json_obj[$i] != null) {
                                 //print_r($json_obj[$i][0]);
                                 $itemList = $json_obj[$i];
                             }
                             
                             for ($j = 0; $j < $item; $j++) {
                                 $item_name = '';
                                 $item_value = '';

                                
                                 if ($json_obj[$j][0] != null) {
                                     //print_r($itemList);
                                     $item_name = $itemList[$j]->name;
                                     $item_value = $itemList[$j]->value;
                                 }
                                 echo "<input name='" . $name . "_name_" . $i . "_" . $j . "' value='" . $item_name . "'></input>";
                                 echo "<input name='" . $name . "_value_" . $i . "_" . $j . "' value='" . $item_value . "'></input>";
                                 echo "<br/>";
                             }
                         }
                     } else {
                         echo "<input value='" . $query_result[0]->$name . "' type='" . $field_setting[$name]['type'] . "' $requiredStr class='form-control' id='$name' name='$name' placeholder='Enter " . $display_field_name[$name]['value'] . "'>";
                     }

                     echo "</div>";
                     echo "</div>";
                 } else {
                     $requiredStr = "";

                     echo "<div class='form-group' style='display:none;'>";
                     echo "<label for='exampleInputEmail1' class='col-sm-2 control-label'>" . $display_field_name[$name]['value'] . "</label>";
                     echo "<div class='col-sm-10'>";

                     if ($field_setting[$name]['type'] == "checkbox") {
                         $checked = '';
                         if ($query_result[0]->$name == "1") {
                             $checked = "checked";
                         }
                         echo "<input value='1' type='" . $field_setting[$name]['type'] . "' $requiredStr $checked class='form-control' id='$name' name='$name' placeholder='Enter " . $display_field_name[$name]['value'] . "'>";
                     } else if ($field_setting[$name]['type'] == "textarea") {
                         echo "<textarea value='" . $query_result[0]->$name . "' id='$name' name='$name' class='form-control' rows='3'></textarea>";
                     } else if ($field_setting[$name]['type'] == "price_list") {
                         echo "<input></input><input></input>";
                         echo "<br/>";
                         echo "<input></input><input></input>";
                         echo "<br/>";
                         echo "<input></input><input></input>";
                         echo "<br/>";
                         echo "<input></input><input></input>";
                         echo "<br/>";
                         echo "<input></input><input></input>";
                         echo "<br/>";
                         echo "<input></input><input></input>";
                         echo "<br/>";
                     } else {
                         echo "<input value='" . $query_result[0]->$name . "' type='" . $field_setting[$name]['type'] . "' $requiredStr class='form-control' id='$name' name='$name' placeholder='Enter " . $display_field_name[$name]['value'] . "'>";
                     }

                     echo "</div>";
                     echo "</div>";
                 }
             } else {
                 echo "<div class='form-group'>";
                 echo "<label for='exampleInputEmail1' class='col-sm-2 control-label'>" . $display_field_name[$name]['value'] . "</label>";
                 echo "<div class='col-sm-10'>";

                 $query = $this->db->get('18_dis');
                 echo"<select id='$name' name='$name' class='form-control'>>";
                 echo "<option value=''></option>";
                 foreach ($query->result() as $row) {
                     if ($query_result[0]->district == $row->string) {
                         echo"<option selected value='$row->string'>$row->string</option>";
                     } else
                         echo"<option value='$row->string'>$row->string</option>";
                 }
                 echo" 
                        </select>
                        ";
             }
         }
        ?>
        <div style="padding:10px;">
            <center>
                <button type="submit" class="btn btn-success form-control">Update</button>
            </center>
        </div>
        <?php
         echo form_close();
        ?>
    </div>


</div>