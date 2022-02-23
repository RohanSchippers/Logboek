<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a2fa64b689.js" crossorigin="anonymous"></script>
    <title>Logboek studie Rohan</title>
</head>
<body>
<h1>Logboek studie Rohan</h1>
<div class="container">
    <?php /** @var Log $editLog */ ?>
    <form class="form" method="post" action="/logboek/logs/upsert">
        <input type="hidden" name="id" value="<?= $editLog->id ?>">
        <label for="vak">Vak:</label><br>
        <input type="text" id="vak" name="vak" placeholder="Vak" value="<?= $editLog->vak ?>"><br>
        <label for="onderwerp">Onderwerp:</label><br>
        <input type="text" id="onderwerp" name="onderwerp" placeholder="Onderwerp"
               value="<?= $editLog->onderwerp ?>"><br>
        <label for="bericht">Bericht:</label><br>
        <textarea name="bericht" id="bericht" cols="30" rows="10"><?= $editLog->bericht ?></textarea>
        <input type="submit" value="Verstuur">
    </form>
    <div class="gridContainer">
        <?php
        /** @var Log[] $logs */
        foreach ($logs as $log) {
            ?>
            <div class="gridItem">
                <h2>Log #<?= $log->id ?> : <?= htmlentities($log->vak) ?> - <?= htmlentities($log->onderwerp) ?> </h2>
                <p> <?= $log->date ?> </p>
                <p> <?= htmlentities($log->bericht) ?> </p>
                <p class="icons">
                    <a href="/logboek/logs/edit/<?= $log->id ?>"><i class="fas fa-edit"></i> </a>
                    <a href="/logboek/logs/delete/<?= $log->id ?>"><i class="fas fa-trash"></i></a>
                </p>
            </div>
            <?php
        }
        ?>

    </div>
</div>
</body>
</html>