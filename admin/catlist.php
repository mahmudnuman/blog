<?php include "inc/header.php";
   include "inc/sidebar.php";
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php

                if (isset($_GET['delid'])){
                    $delid=$_GET['delid'];
                    $delquery="DELETE FROM tbl_catagory WHERE id='$delid'";
                       $deldata = $db->delete($delquery);
                    if ($deldata){

                        echo "<span style='color:green;font-size=18px;'>Category Deleted!</span>";
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
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query="SELECT * FROM tbl_catagory ORDER BY id DESC ";
                    $categoy=$db->select($query);
                    if ($categoy){
                        $i=0;
                        while ($result=$categoy->fetch_assoc()){

                        $i++;





                    ?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name']; ?></td>
							<td><a  href="editcat.php?catid=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are You sure to Delete ? ')" href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
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
