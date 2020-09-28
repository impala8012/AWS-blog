<?php 
    session_start();
    require_once('conn.php');
    require_once('utils.php');

    $username = null;
    if(!empty($_SESSION['username'])) {
      $username = $_SESSION['username'];
    }
    $sql = "SELECT * FROM impala8012_articles WHERE is_deleted is NULL ORDER BY id";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    $result = $stmt->get_result();
?>


<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">

  <title>部落格</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
<?php include_once('header.php')?>

  <section class="banner">
    <div class="banner__wrapper">
      <h1>存放技術之地</h1>
      <div>Welcome to my blog</div>
    </div>
  </section>
  <div class="container-wrapper">
    <div class="container">
    <?php while($row = $result->fetch_assoc()) { ?>
      <div class="admin-posts">
        <div class="admin-post">
          <div class="admin-post__title">
            <a href="blog.php?id=<?php echo escape($row['id']) ?>"><?php echo escape($row['title']) ?></a>
          </div>
          <div class="admin-post__info">
            <div class="admin-post__created-at">
              <?php echo escape($row['created_at'])?>
              <span class="category">分類:<?php echo escape($row['name'])?></span>
            </div>
            <?php if(!empty($username)) { ?>
                <a class="admin-post__btn" href="update.php?id=<?php echo escape($row['id'])?>">
                編輯
                </a>
                <a class="admin-post__btn" href="delete_articles.php?id=<?php echo escape($row['id'])?>">
                刪除
                </a>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php }?>
    </div>
  </div>
  <footer>Copyright © 2020 Who's Blog All Rights Reserved.</footer>
</body>
</html>