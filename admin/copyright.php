<?php include"inc/header.php"; ?>
<?php include"inc/sidebar.php"; ?>
        <div class="grid_10">
		

            <div class="box round first grid">
                <h2>Update Copyright Text</h2>

<?php

                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $text = $fm->validation($_POST['text']);
                   $text = mysqli_real_escape_string($db->link, $text);
                    if ($text==""){

                        echo "<span style='color:red;font-size=18px;'>Empty Fields are not Allowed !</span>";

                    } else {
                        $query = "UPDATE tbl_footer SET
                        
                        text='$text' 
                       WHERE id='1'";
                        $updated_row = $db->update($query);
                        if ($updated_row) {

                            echo "<span style='color:green;font-size=18px;'>info Has Been Updated !</span>";

                        } else {
                            echo "<span style='color:red;font-size=18px;'>info Update Error !</span>";

                        }

                    }


                }

                ?>

                <div class="block copyblock"> 
                 <?php
    $query="SELECT * FROM tbl_footer WHERE id='1'";
    $social=$db->select($query);
    if ($social){
    while ($result=$social->fetch_assoc()){
 ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['text'];?>" name="text" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }}?>
                </div>
            </div>
        </div>
         <?php include "inc/footer.php";?>
