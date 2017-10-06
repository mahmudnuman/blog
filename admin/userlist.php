<?php include "inc/header.php";
   include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <?php

                if (isset($_GET['deluser'])){
                    $delid=$_GET['deluser'];
                    $delquery="DELETE FROM tbl_user WHERE id='$delid'";
                       $deldata = $db->delete($delquery);
                    if ($deldata){

                        echo "<span style='color:green;font-size=18px;'>User Deleted!</span>";
                    } else{

                        echo "<span style='color:red;font-size=18px;'>Delete Error!</span>";
                    }
                }


                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Details</th>
                            <th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query="SELECT * FROM tbl_user ORDER BY id DESC ";
                    $user=$db->select($query);
                    if ($user){
                        $i=0;
                        while ($result=$user->fetch_assoc()){

                        $i++;





                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <td><?php echo $result['email']; ?></td>
                            <td><?php echo $fm->textshorten($result['details'],30); ?></td>
                            <td><?php 

                                    if ($result['role']=='1') {
                                       echo "Admin";
                                    }elseif ($result['role']=='2') {
                                        echo "Author";
                                    }elseif ($result['role']=='3') {
                                        echo "Editor";
                                    }


                             ?></td>
							<td><a  href="viewuser.php?userid=<?php echo $result['id']; ?>">View</a><a <?php if (Session::get('UserRole')=='1') {?> onclick="return confirm('Are You sure to Delete ? ')" href="?deluser=<?php echo $result['id']; ?>">|| Delete</a>
                                    <?php }?>
                            </td>
						</tr>
                    <?php }}?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>
        <?php  include "inc/footer.php";?>
