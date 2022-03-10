<?php

require_once "Log.php";
require_once "Vak.php";

/**
 * @return Log[]
 */
function getLogs(): array
{
    global $pdo;
    $logs = $pdo->
    query("
    SELECT logs.*, vakken.naam AS vak 
    FROM logs 
    JOIN vakken ON logs.vak_id = vakken.id 
    ORDER BY logs.id DESC")
        ->fetchAll(PDO::FETCH_CLASS, Log::class);
    return $logs;
}

function getLog(int $id): Log     // Returned een object van het type Log
{
    global $pdo;
    $statement = $pdo->prepare('
        SELECT logs.*, vakken.naam AS vak
        FROM logs 
        JOIN vakken ON logs.vak_id = vakken.id
        WHERE logs.id = ? LIMIT 1');
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
    $statement = $pdo->prepare('UPDATE logs 
    SET 
        datum = NOW(), 
        onderwerp = ? , 
        hoe = ? , 
        stappen = ?, 
        evaluatie = ?, 
        planning = ?, 
        terugkijken = ?, 
        minuten_besteed = ?, 
        vak_id = ? 
    WHERE id = ?');
    $statement->execute(
        [
            $values['onderwerp'],
            $values['hoe'],
            $values['stappen'],
            $values['evaluatie'],
            $values['planning'],
            $values['terugkijken'],
            $values['minuten_besteed'],
            $values['vak_id'],
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

function getVakken(): array
{
    global $pdo;
    return $pdo->
    query("SELECT * FROM vakken ORDER BY naam ASC")
        ->fetchAll(PDO::FETCH_CLASS, Vak::class);
}