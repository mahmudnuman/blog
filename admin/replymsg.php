<?php include "inc/header.php";
include "inc/sidebar.php";
?><?php 

if (!isset($_GET['msgid'])||$_GET==NULL){
  
} else{
    $id=$_GET['msgid'];

}

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') { 
                    $to=$fm->validation($_POST['toEmail']);
                    $from=$fm->validation($_POST['fromEmail']);
                    $subject=$fm->validation($_POST['subject']);
                    $message=$fm->validation($_POST['message']);
                    $sendmail=mail($to, $subject, $message,$from);
                    if ($sendmail) {
                        echo "<span style='color:green'>Message Sent Successfully </span>";
                    } else{

                             echo "<span style='color:red'>Something Went Wrong!</span>";

                    }
                    

                }
                ?>
                <div class="block">               
                 <form action=" " method="post" >
                    <table class="form">

                    <?php
                    $query="SELECT * FROM tbl_contact WHERE id='$id'";  
                    $msg=$db->select($query);
                    if ($msg){
                        while ($result=$msg->fetch_assoc()){


                    ?>
                       

                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="email"  name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                     <tr>
                      <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Enter Your Email" class="medium" />
                            </td>
                        </tr>
                     <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text"  name="subject" placeholder="Please Enter The Subject "  class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message"> </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    <?php }}?>
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


