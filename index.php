<?php
include_once 'lib/lib.php';
include_once 'config/Database.php';
include_once 'class/Articles.php';

$database = new Database();
$db = $database->getConnection();

$article = new Articles($db);
$result = $article->getArticles();
?>

<title> Content Management System</title>
<div id="blog" class="row">		
    <?php
    if ($result->num_rows > 0) {
        while ($post = $result->fetch_assoc()) {
            $date = new DateTime($post['created']); // Use DateTime directly
            $formattedDate = $date->format("d F Y");

            $message = str_replace("\n\r", "<br><br>", $post['message']);
            ?>
            <div class="col-md-10 blogShort">
                <h3><a href="view.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h3>
                <em><strong>Published on</strong>: <?php echo $formattedDate; ?></em>
                <em><strong>Category:</strong>
                    <a href="#" target="_blank"><?php echo $post['category']; ?></a></em>
                <br><br>
                <article>
                    <p><?php echo $message; ?></p>
                </article>
                <a class="btn btn-blog pull-right" href="view.php?id=<?php echo $post['id']; ?>">READ MORE</a>
            </div>
        <?php
        }
    } else {
        ?>
        <div>No articles found</div>
    <?php
    }
    ?>
</div>
