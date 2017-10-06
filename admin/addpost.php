﻿<?php include "inc/header.php";
include "inc/sidebar.php";
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $title = mysqli_real_escape_string($db->link, $_POST['title']);
                    $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
                    $body = mysqli_real_escape_string($db->link, $_POST['body']);
                    $author = mysqli_real_escape_string($db->link, $_POST['author']);
                    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

                    $permitted=array('jpg','jpeg','png','gif');
                    $file_name=$_FILES['image']['name'];
                    $file_size=$_FILES['image']['size'];
                    $file_temp=$_FILES['image']['tmp_name'];

                    $div=explode('.',$file_name);
                    $file_ext=strtolower(end($div));
                    $unique_image=substr(md5(time()),0,10).'.'.$file_ext;
                    $uploaded_image="upload/".$unique_image;

                    if ($title==""||$cat==""||$body==""||$author==""||$tags==""||$file_name==""){

                        echo "<span style='color:red;font-size=18px;'>Epmty Feilds are not Allowed !</span>";
                    } elseif ($file_size>1048567){

                        echo "<span style='color:red;font-size=18px;'>Image Should be Less then 1 MB!</span>";
                    } elseif (in_array($file_ext,$permitted)===false){

                        echo "<span style='color:red;font-size=18px;'>You can Upload Only JPG or JPEG or PNG or GIF  files !</span>";

                    } else{
                            move_uploaded_file($file_temp,$uploaded_image);
                            $query="INSERT INTO tbl_post(cat,title,body,image,author,tags) VALUES ('$cat','$title','$body','$uploaded_image','$author','$tags')";

                            $insertpost=$db->insert($query);
                            if ($insertpost){

                                echo "<span style='color:green;font-size=18px;'>A New Post Added !</span>";

                            } else{
                                echo "<span style='color:red;font-size=18px;'>Post Insertion Error !</span>";

                            }

                    }
                }
                ?>
                <div class="block">               
                 <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option >Select Category</option>
                                    <?php
                                        $query="SELECT * FROM tbl_catagory";
                                        $category=$db->select($query);
                                        if ($category){
                                                while ($result=$category->fetch_assoc()){



                                        ?>

                                    <option value="<?php  echo $result['id'];?>"><?php  echo $result['name'];?></option>
                                    <?php }

                                        }
                                        else{
                                            echo "No Category Available";
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>
                   

                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image" />
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
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly name="author"  value="<?php echo Session::get('username'); ?>" class="medium" />
                            </td> 
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Tags..." class="medium" />
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

