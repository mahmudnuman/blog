<?php include "inc/header.php";
include "inc/sidebar.php";
?>
    <div class="grid_10">

        <div class="box round first grid">
            <h2>Theme Select</h2>
            <div class="block copyblock">
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $theme = $_POST['theme'];
                    $theme = mysqli_real_escape_string($db->link, $theme);

                      $query="UPDATE tbl_theme SET theme='$theme' WHERE id='1'";
                      $update= $db->update($query);
                        if ($update){

                            echo "<span style='color:green;font-size=18px;'>Theme Updated!</span>";
                        } else{

                            echo "<span style='color:red;font-size=18px;'>Update Error!</span>";
                        }
                    }


                ?>
                <?php

                $query= "SELECT * FROM tbl_theme WHERE id='1'";
              $theme = $db->select($query);
              while ($result=$theme->fetch_assoc()){

                ?>
                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input <?php if ($result['theme']=='default') {echo "Checked";} ?> type="radio" name="theme" value="deafult" />Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input  <?php if ($result['theme']=='green') {echo "Checked";} ?> type="radio" name="theme" value="green" />Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input  <?php if ($result['theme']=='red') {echo "Checked";} ?> type="radio" name="theme" value="red" />Red
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                </form>
              <?php  } ?>
            </div>
        </div>
    </div>
<?php include "inc/footer.php";?>
