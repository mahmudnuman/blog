<?php include "inc/header.php";
include "inc/sidebar.php";
?>

<?php
if (!isset($_GET['pageid'])||$_GET==NULL){
  echo "<script>window.location='index.php';</script>";

} else{
    $id=$_GET['pageid'];

}

?>
<style>
.actiondel{margin-left: 10px;} 
.actiondel a{

background: #f0f0f0 none repeat scroll 0 0;
border: 1px solid #ddd;
color: #444;
cursor: pointer;
font-size: 20px;
font-weight: normal;
padding: 4px 10px;

}   

</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Page Update</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') { 
                    $name = mysqli_real_escape_string($db->link, $_POST['name']);
                    $body = mysqli_real_escape_string($db->link, $_POST['body']);

                    if ($name==""||$body==""){

                        echo "<span style='color:red;font-size=18px;'>Epmty Feilds are not Allowed !</span>";
                    } else{
                            $query="UPDATE tbl_page SET name='$name',body='$body' WHERE id='$id'";

                            $updatepost=$db->insert($query);
                            if ($updatepost){

                                echo "<span style='color:green;font-size=18px;'>Page Has Been Updated !</span>";

                            } else{
                                echo "<span style='color:red;font-size=18px;'>Page Updated Error !</span>";

                            }

                    }
                }
                ?>
                <div class="block"> 
                <?php
                        $query="SELECT * FROM tbl_page WHERE id='$id'";
                        $Pages=$db->select($query);
                        if ($Pages){
                            while ($result=$Pages->fetch_assoc()){



                    ?>              
                 <form action=" " method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body'];?></textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="actiondel" ><a  <a onclick="return confirm('Are You sure to Delete This Page ? ')" href="delpage.php?delpage=<?php echo $result['id']; ?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }}?>
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


