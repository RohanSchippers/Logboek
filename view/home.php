<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/view/css/style.css">
    <script src="https://kit.fontawesome.com/a2fa64b689.js" crossorigin="anonymous"></script>
    <title>Logboek studie Rohan</title>
</head>
<body>
<h1>Logboek studie Rohan</h1>
<div class="container">
    <?php /** @var Log $editLog */ ?>
    <form class="form" method="post" action="/logs/upsert">
        <input type="hidden" name="id" value="<?= $editLog->id ?>">
        <label for="vak_id">Vak:</label><br>
        <select name="vak_id" id="vak_id">
            <?php /** @var Vak[] $vakken */ ?>
            <?php foreach ($vakken as $vak): ?>
            <option value="<?= $vak->id ?>"><?= $vak->naam ?></option>
            <?php endforeach; ?>
        </select>
        <label for="onderwerp">Onderwerp:</label><br>
        <input type="text" id="onderwerp" name="onderwerp" placeholder="Onderwerp"
               value="<?= $editLog->onderwerp ?>"><br>
        <label for="hoe">Hoe:</label><br>
        <textarea name="hoe" id="hoe" cols="15" rows="5"><?= $editLog->hoe ?></textarea>
        <label for="planning">Planning:</label><br>
        <textarea name="planning" id="planning" cols="15" rows="5"><?= $editLog->planning ?></textarea>
        <label for="stappen">Stappen:</label><br>
        <textarea name="stappen" id="stappen" cols="15" rows="5"><?= $editLog->stappen ?></textarea>
        <label for="evaluatie">Evaluatie:</label><br>
        <textarea name="evaluatie" id="evaluatie" cols="15" rows="5"><?= $editLog->evaluatie ?></textarea>
        <label for="terugkijken">Terugkijken:</label><br>
        <textarea name="terugkijken" id="terugkijken" cols="15" rows="5"><?= $editLog->terugkijken ?></textarea>
        <label for="minuten_besteed">Minuten besteed:</label>
        <input type="number" id="minuten_besteed" name="minuten_besteed" value="<?= $editLog->minuten_besteed ?>">
        <input type="submit" value="Verstuur">
    </form>
    <div class="gridContainer">
        <?php
        /** @var Log[] $logs */
        foreach ($logs as $log) {
            ?>
            <div class="gridItem">
                <h2>Log #<?= $log->id ?> : <?= htmlentities($log->vak) ?> - <?= htmlentities($log->onderwerp) ?> </h2>
                <p> <?= $log->datum ?> </p>
                <h4>Minuten besteed:</h4>
                <p> <?= $log->minuten_besteed ?> </p>
                <h4>Hoe:</h4>
                <p> <?= htmlentities($log->hoe) ?> </p>
                <h4>Planning:</h4>
                <p> <?= htmlentities($log->planning) ?> </p>
                <h4>Stappen:</h4>
                <p> <?= htmlentities($log->stappen) ?> </p>
                <h4>Evaluatie:</h4>
                <p> <?= htmlentities($log->evaluatie) ?> </p>
                <h4>Terugkijken:</h4>
                <p> <?= htmlentities($log->terugkijken) ?> </p>
                <p class="icons">
                    <a href="/logs/edit/<?= $log->id ?>"><i class="fas fa-edit"></i></a>
                    <a href="/logs/delete/<?= $log->id ?>"><i class="fas fa-trash"></i></a>
                </p>
            </div>
            <?php
        }
        ?>

    </div>
</div>
</body>
</html>