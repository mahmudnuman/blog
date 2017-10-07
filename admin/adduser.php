
<?php include "inc/header.php";
include "inc/sidebar.php";
?>
<?php

    if (!Session::get('userRole')=='1') {

        echo "<script>window.location='index.php';</script>";

    }


 ?>
        <div class="grid_10">

            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">
                   <?php
                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $username = $fm->validation($_POST['username']);
                            $password = $fm->validation(md5($_POST['password'])) ;
                            $role = $fm->validation($_POST['role']);

                            $username = mysqli_real_escape_string($db->link, $username);
                            $password = mysqli_real_escape_string($db->link, $password);
                            $role = mysqli_real_escape_string($db->link, $role);

                            if (empty($username)||empty($password)||empty($role)){
                            echo "<span style='color:red;font-size=18px;'>Epmty Fields are not Allowed !</span>";
                        }else{

                                $query="INSERT INTO tbl_user (username,password,role) VALUES ('$username','$password','$role')";
                               $userinsert= $db->insert($query);
                               if ($userinsert){

                                   echo "<span style='color:green;font-size=18px;'>User Added !</span>";
                               } else{

                                   echo "<span style='color:red;font-size=18px;'>Insertion Error!</span>";
                               }
                            }

                        }
                        ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                        <td>
                        	<label>Username</label>
                        </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                        	<label>Password</label>
                        </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                        	<label>Role</label>
                        </td>
                            <td>
                                <select id="select" name="role">

                                	<option>Select User Role</option>
                                	<option value="1" >Admin</option>
                                	<option value="2" >Author</option>
                                	<option value="3">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr> <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>
