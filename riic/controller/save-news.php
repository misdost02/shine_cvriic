<?php
session_start();

include("../../config/config.php");

if(!empty($_POST)) {
	if(isset($_POST['news_title']) && isset($_POST['news_article'])) {
		$news_title = $conn->real_escape_string($_POST['news_title']);
		$news_article = $conn->real_escape_string($_POST['news_article']);
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $news_title);
		$token_id = sha1(md5(strtotime(date('m-d-y h:i:s'))));
		
		$news_author = $_SESSION['adminname'];

		$check_news= "SELECT * FROM tbl_news_articles WHERE news_title = '$news_title' AND news_slug = '$slug'";
		$qry_news = $conn->query($check_news);
		$ctr_news = $qry_news->num_rows;

		if($ctr_news == 0) {
			$str_insert = "INSERT INTO tbl_news_articles (news_title, news_slug, news_article, news_author, news_status, token_id) VALUES ('$news_title', '$slug', '$news_article', '$news_author', '1', '$token_id')";
			$qry_insert = $conn->query($str_insert);
			
			if($qry_insert == true) {
				echo "1";
			} else {
				echo "2";
			}
			
		} else {
			echo "0";
		}
	}
}


// ADD PHOTO ARTICLE
if(isset($_POST["news_image"])) {
	$data = $_POST["news_image"];
	$news_id = $_POST["news_id"];

	$image_array_1 = explode(";", $data);
	$image_array_2 = explode(",", $image_array_1[1]);
	$data = base64_decode($image_array_2[1]);
	$imageName = time().'.png';
	file_put_contents("../../images/news-photo/".$imageName, $data);
	// $file_content = addslashes(file_get_contents("../photos/".$imageName, $data));

	$check_photo = "SELECT * FROM tbl_news_articles WHERE news_id = '$news_id'";
	$qry_photo = $conn->query($check_photo);
	$count_photo = $qry_photo->num_rows;

	if($count_photo == 1) {
		$insert_photo = "UPDATE tbl_news_articles SET news_photo = '$imageName' WHERE news_id = '$news_id'";
	}
	
	$qry = $conn->query($insert_photo);

	if($qry == true) {
		echo 1;
	} else {
		echo 0;
	}
}

?>