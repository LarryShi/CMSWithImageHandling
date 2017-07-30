<?php
$this->load->helper('form');
?>

<!--<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

        <title>CMS</title>

        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    </head>
    
    <body>-->
        <div class="panel panel-default" style="padding: 15px;">
        <?php echo form_open_multipart('admin_platform/' . $module_name . '/update/');?>
            <style>
                .slideshow_img {
                    width: 300px;
                }
            </style>
             
        <div class="input-group">
            <label for="slideshow_1">Slideshow 1</label>
            <input type="file" class="form-control" name="slideshow_1"><br/>
            <?php 
                if ($query_result[0]->slideshow_1){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_1."'></img>";
                }
            ?>
            <br/>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url1">
            </div>
        </div>

            <div class="input-group">
            <label for="slideshow_2">Slideshow 2</label> 
            <input type="file" class="form-control" name="slideshow_2"><br/>
            <?php 
                if ($query_result[0]->slideshow_2){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_2."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url2">
          </div>
            <br/>

            </div>
          
            <div class="input-group">
            <label for="slideshow_3">Slideshow 3</label> 
            <input type="file" class="form-control" name="slideshow_3"><br>
            <?php 
                if ($query_result[0]->slideshow_3){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_3."'></img>";
                }
            ?>
             <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url3">
            </div>
            <br/>

            </div>

            <div class="input-group">
            <label for="slideshow_4">Slideshow 4</label> 
            <input type="file" class="form-control" name="slideshow_4"><br>
            <?php 
                if ($query_result[0]->slideshow_4){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_4."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url4">
            </div>
                
            <br/>

            </div>

            <div class="input-group">
            <label for="slideshow_5">Slideshow 5</label> 
            <input type="file" class="form-control" name="slideshow_5"><br>
            <?php 
                if ($query_result[0]->slideshow_5){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_5."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url5">
            </div>    

            <br/>

            </div>

            <div class="input-group">
            <label for="slideshow_6">Slideshow 6</label> 
            <input type="file" class="form-control" name="slideshow_6"><br>
            <?php 
                if ($query_result[0]->slideshow_6){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_6."'></img>";
                }
            ?>
                
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url6">
            </div>
            <br/>

            </div>

            <div class="input-group">
            <label for="slideshow_7">Slideshow 7</label> 
            <input type="file" class="form-control" name="slideshow_7"><br>
            <?php 
                if ($query_result[0]->slideshow_7){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_7."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url7">
            </div>
   
          
            <br/>

            </div>

            <div class="input-group">
            <label for="slideshow_8">Slideshow 8</label> 
            <input type="file" class="form-control" name="slideshow_8"><br>
            <?php 
                if ($query_result[0]->slideshow_8){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_8."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url8">
            </div>
            <br/>

            </div>
            <div class="input-group">
            <label for="slideshow_9">Slideshow 9</label> 
            <input type="file" class="form-control" name="slideshow_9"><br>
            <?php 
                if ($query_result[0]->slideshow_9){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_9."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url9">
            </div>
            <br/>

            </div>

            <div class="input-group">
            <label for="slideshow_10">Slideshow 10</label> 
            <input type="file" class="form-control" name="slideshow_10"><br>
            <?php 
                if ($query_result[0]->slideshow_10){
                    echo "<img class='slideshow_img' src='/tophair_uploaded_image/img/".$query_result[0]->slideshow_10."'></img>";
                }
            ?>
            <div class="input-group">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button">U R L:</button>
            </span>
            <input type="text" class="form-control" name="url10">
            </div>        

            <br/>
 
            </div>
            
        </div>
            <center>
            <button class="btn btn-success" type="submit" value="upload">Update</button>
            </center>
        <?php
            echo form_close();
        ?>
        </div>
        
<!--    </body>
        </html>-->