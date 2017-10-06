﻿<?php include"inc/header.php"; ?>
<?php include"inc/sidebar.php"; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php 

                	if (isset($_GET['seenid'])) {
                		$seenid=$_GET['seenid'];
                		$query="UPDATE tbl_contact SET status='1' WHERE id=$seenid";
                		$update_seen=$db->update($query);
                		if ($update_seen) {
                			echo "<span style='color:green'>Message Sent To The Seen Box </span>";
                		}else{
                				echo "<span style='color:green'>Message Can Not Sent To The Seen Box </span>";

                		}
                	}

                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					 <?php
                    $query="SELECT * FROM tbl_contact WHERE status='0' ORDER BY id DESC";  
                    $msg=$db->select($query);
                    if ($msg){
                        $i=0;
                        while ($result=$msg->fetch_assoc()){

                        $i++;





                    ?>
						
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textshorten($result['body'],30); ?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td>
							<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
							<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a>||
							<a onclick="return confirm('Are You sure to Move  ? ');" href="?seenid=<?php echo $result['id']; ?>">Seen</a>||
							 </td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>
               </div>
            </div>
            <div class="box round first grid">
                <h2>Seen Messages</h2>
                <?php 

                	if (isset($_GET['delid'])) {
                		$delid=$_GET['delid'];
                		$query="DELETE FROM tbl_contact WHERE id='$delid'";
                		$delid_seen=$db->delete($query);
                		if ($delid_seen) {
                			echo "<span style='color:green'>Message Deleted Successfully</span>";
                		}else{
                				echo "<span style='color:green'>Message Can Not Be Deleted</span>";

                		}
                	}

                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						 <?php
                    $query="SELECT * FROM tbl_contact WHERE status='1' ORDER BY id DESC";  
                    $msg=$db->select($query);
                    if ($msg){
                        $i=0;
                        while ($result=$msg->fetch_assoc()){

                        $i++;





                    ?>
						
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textshorten($result['body'],30); ?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td>
							<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
							<a onclick="return confirm('Are You sure to Delete ? ');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
							 </td>
						</tr>
						<?php }} ?>
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
