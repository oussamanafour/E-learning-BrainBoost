<?php
    include('../connection/connection.php');
    if(isset($_GET['View_Video'])){
        $id = $_GET['View_Video'];
        $querylesson = $connection->prepare('SELECT * FROM lessons WHERE id_lesson=:id');
        $querylesson->bindValue(':id',$id);
        $querylesson->execute();
        $res = $querylesson->fetch();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../BootstrapCSS/bootstrap.min.css">
    <link rel="icon" type="image" href="../images_for_dev/brainboost.png">
    <title>view video</title>
</head>
<body>
        <div class="container" style="margin-top: 50px;">
                    <h1 class="text-center"><?= $res['title'];?></h1>
                <div class="card p-3">
                    <video class="mx-auto" width="1000" height="700" controls autoplay muted src="../videosForLessons/<?= $res['contenu_video'];?>"></video>
                </div>
                <a href="lessonsList.php" class="btn btn-primary btn-sm mt-3">back</a>
        </div>
</body>
</html>