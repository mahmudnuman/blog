<?php include "inc/header.php";
include "inc/sidebar.php";
?>
        <div class="grid_10">
		<?php



if (Session::get('userRole')=='2') {
  echo "<script>window.location='index.php';</script>";
}
     ?>
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $name = mysqli_real_escape_string($db->link, $_POST['name']);
                    $body = mysqli_real_escape_string($db->link, $_POST['body']);

                    if ($name==""||$body==""){

                        echo "<span style='color:red;font-size=18px;'>Epmty Feilds are not Allowed !</span>";
                    } else{
                            $query="INSERT INTO tbl_page(name,body) VALUES ('$name','$body')";

                            $insertpost=$db->insert($query);
                            if ($insertpost){

                                echo "<span style='color:green;font-size=18px;'>A New Page Added !</span>";

                            } else{
                                echo "<span style='color:red;font-size=18px;'>Page Insertion Error !</span>";

                            }

                    }
                }
                ?>
                <div class="block">
                 <form action=" " method="post" >
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
                    <!--load TinyMCE--->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
            <!--load TinyMCE--->
        <?php include "inc/footer.php"?>
