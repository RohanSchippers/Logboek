<?php

require_once "Log.php";

/**
 * @return Log[]
 */
function getLogs(): array
{
    global $pdo;
    $logs = $pdo->
    query("SELECT * FROM logs ORDER BY id DESC")
        ->fetchAll(PDO::FETCH_CLASS, Log::class);
    return $logs;
}

function getLog(int $id): Log     // Returned een object van het type Log
{
    global $pdo;
    $statement = $pdo->prepare('SELECT * FROM logs WHERE id = ? LIMIT 1');
    $statement->execute(
        [
            $id
        ]
    );
    return $statement->fetchObject(Log::class); // Geeft volledig namespace path aan naar de class "\Log"
}

function createLog(array $values)
{
    global $pdo;
    $statement = $pdo->prepare('
    INSERT INTO logs 
        (onderwerp, hoe, stappen, evaluatie, planning, terugkijken, minuten_besteed, vak_id) 
        VALUES (?, ?, ?, ? , ? , ? , ? , ?)');
    $statement->execute(
        [
            $values['vak'],
            $values['onderwerp'],
            $values['hoe'],
            $values['stappen'],
            $values['evaluatie'],
            $values['planning'],
            $values['terugkijken'],
            $values['minuten_besteed'],
            $values['vak_id'],
        ]
    );
}

function updateLog(array $values)
{
    global $pdo;
    $statement = $pdo->prepare('UPDATE logs SET date = NOW(), vak = ? , onderwerp = ? , bericht = ? WHERE id = ?');
    $statement->execute(
        [
            $values['vak'],
            $values['onderwerp'],
            $values['bericht'],
            $values['id'],
        ]
    );
}

function deleteLog(int $id)
{
    global $pdo;
    $statement = $pdo->prepare('DELETE FROM logs WHERE id = ?'); // DELETE FROM tabel WHERE kolom = ??
    $statement->execute(
        [
            $id
        ]
    );
}