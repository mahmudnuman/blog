 <?php include 'inc/header.php';?>
<?php

if (!isset($_GET['id'])||$_GET['id'] == null){

    header("Location:404.php");

}
else{

 $id=$_GET['id'];
}

?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
                <?php $query="Select * FROM tbl_post WHERE id=$id";
                $post = $db->select($query);

            if ($post){

                while($result=$post->fetch_assoc()){

                ?>
				<h2> <?php echo $result['title'] ?></h2>
                <h4><?php echo $fm->formatDate($result['date']);?>, By <a href="#"><?php echo $result['author'];?></a></h4>
                <img src="admin/<?php echo $result['image'] ?>" alt="post image"/>
                <?php echo $result['body']; ?>
                 <p>Tags:</p><?php echo $result['tags']; ?>
				<div class="relatedpost clear">
					<h2>Related articles</h2>
                    <?php
                    $catid=$result['cat'];
                    $c="Select * FROM tbl_post WHERE cat='$catid' ORDER BY rand() LIMIT 6 ";
                    $relatedpost = $db->select($c);

                     if ($relatedpost){

                    while($rresult=$relatedpost->fetch_assoc()){


                    ?>
                   <a href="post.php?id=<?php echo $rresult['id'];?>">
                       <img src="admin/<?php echo $rresult['image']; ?>" alt="post image"/></a>
					<?php }} else {
                echo "No Related Post Available Now! "; }?>
				</div>
                <?php } } else {header("Location:404.php");} ?>
	        </div>
        </div>
        <?php include 'inc/sidebar.php'; ?>
        <?php include 'inc/footer.php'; ?>