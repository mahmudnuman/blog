<?php

if (isset($_GET['pageid'])) {
	$pagetitle=$_GET['pageid'];
	$query="SELECT * FROM tbl_page WHERE id='$pagetitle'";
	$pages=$db->select($query);
	if ($pages) {
		while ($result=$pages->fetch_assoc()) { ?>
			<title><?php echo $result['name'] ?> - <?php echo TITLE; ?></title>


		<?php }
	}
} elseif (isset($_GET['id'])) {
	$postid=$_GET['id'];
	$pquery="SELECT * FROM tbl_post WHERE id='$postid'";
	$posts=$db->select($pquery);
	if ($posts) {
		while ($presult=$posts->fetch_assoc()) { ?>
			<title><?php echo $presult['title']; ?> - <?php echo TITLE; ?></title>


		<?php }
	}
} else { ?>


	<title><?php echo $fm->title(); ?> - <?php echo TITLE; ?></title>

<?php  }?>
	<title><?php echo TITLE; ?></title>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php

	if (isset($_GET['id'])) {
		$keywordid=$_GET['id'];
			$query="SELECT * FROM tbl_post WHERE id='$keywordid'";
			$keywords=$db->select($query);
			if ($keywords) {
				while ( $result=$keywords->fetch_assoc()) { ?>

				<meta name="keywords" content="<?php echo $result['tags']; ?>">
				<meta name="author" content="<?php echo $result['author']; ?>">


		<?php }}} else {?>
		<meta name="keywords" content="<?php echo KEYWORDS; ?>">
		<meta name="author" content="Kaktarua">
		<?php }?>
