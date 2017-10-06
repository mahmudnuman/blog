<?php include 'inc/header.php';?>

<?php
if (!isset($_GET['pageid'])||$_GET==NULL){
  echo "<script>window.location='404.php';</script>";

} else{
    $id=$_GET['pageid'];

}

?>
					<?php
                        $query="SELECT * FROM tbl_page WHERE id='$id'";
                        $Pages=$db->select($query);
                        if ($Pages){
                            while ($result=$Pages->fetch_assoc()){



                    ?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			  
				<h2><?php echo $result['name']; ?></h2>
				<p><?php echo $result['body']; ?></p>
	
				

				
	</div>

		</div>
		<?php }} else{ header("location:404.php");} ?>
        <?php include 'inc/sidebar.php'; ?>
        <?php include 'inc/footer.php'; ?>
