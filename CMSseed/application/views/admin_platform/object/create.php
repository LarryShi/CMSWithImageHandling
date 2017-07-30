<?php
 $this->load->helper('form');
?>
<div style="padding: 15px;">Create - <?php echo $object_name; ?></div>

<div style="padding: 15px;">
    <div class="panel panel-default" style="padding: 15px;">
        <?php
         $attributes = array('id' => 'create_form', 'class' => 'form-signin', 'role' => 'form', 'enctype' => "multipart/form-data");
         echo form_open('admin_platform/' . $module_name . '/insert', $attributes);

         foreach ($field_setting as $name => $data) {
             if ($field_setting[$name]['display'] == true) {
                 if ($display_field_name[$name]['value'] != '地區') {
                     $requiredStr = "";
                     if ($field_setting[$name]['required'] && $field_setting[$name]['required'] == true) {
                         $requiredStr = "required";
                     }
                     echo "<div class='form-group'>";
                     echo "<label for='exampleInputEmail1' class='col-sm-2 control-label'>" . $display_field_name[$name]['value'] . "</label>";
                     echo "<div class='col-sm-10'>";
                     if ($field_setting[$name]['type'] == "checkbox") {
                         echo "<input value='1' type='" . $field_setting[$name]['type'] . "' $requiredStr class='form-control' id='$name' name='$name' placeholder='Enter " . $display_field_name[$name]['value'] . "'>";
                     } else if ($field_setting[$name]['type'] == "textarea") {
                         echo "<textarea id='$name' name='$name' class='form-control' rows='3'></textarea>";
                     } else if ($field_setting[$name]['type'] == "dropdown") {
                         $data_array = $field_setting[$name]['list'];
                         echo "<select id='$name' name='$name' class='form-control'>";
                         foreach ($data_array as $option_row) {
                             echo "<option value='" . $option_row->option_value . "'>" . $option_row->option_name . "</option>";
                         }
                         echo "</select>";
                     } else if ($field_setting[$name]['type'] == "price_list") {
                         $group = 6;
                         $item = 8;

                         for ($i = 0; $i < $group; $i++) {
                             echo "<input name='" . $name . "_" . $i . "' class='form-control'></input>";
                             for ($j = 0; $j < $item; $j++) {
                                 echo "<input name='" . $name . "_name_" . $i . "_" . $j . "'></input>";
                                 echo "<input name='" . $name . "_value_" . $i . "_" . $j . "'></input>";
                                 echo "<br/>";
                             }
                         }
                     } else {
                         echo "<input type='" . $field_setting[$name]['type'] . "' $requiredStr class='form-control' id='$name' name='$name' placeholder='Enter " . $display_field_name[$name]['value'] . "'>";
                     }
                     echo "</div>";
                     echo "</div>";
                 }
                 //camille edit for district
                 else {
                     echo "<div class='form-group'>";
                     echo "<label for='exampleInputEmail1' class='col-sm-2 control-label'>" . $display_field_name[$name]['value'] . "</label>";
                     echo "<div class='col-sm-10'>";

                       $query=$this->db->get('18_dis');
                     echo"<select id='$name' name='$name' class='form-control'>";
                     echo "<option value=''></option>";
                     foreach ($query->result() as $row)
                     {
                        echo"<option value='$row->string'>$row->string</option>";
                     }
                        echo" 
                        </select>
                        ";
                 }
             }
         }
        ?>
        <br/>
        <center>
            <button id='create_button' type='submit' class="btn btn-success form-inline">Create</button>
        </center>
        <?php
         echo form_close();
        ?>

    </div>
</div>