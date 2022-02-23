<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "model/database.php";

// start een applicatie met behulp van url
//Hiermee request je de url, en begin je bij de eerste /
$request = substr($_SERVER["REQUEST_URI"], 1);

//Pakt alle dingen die tussen / / staan, en maakt er aan array van
$params = explode("/", $request);
// We weten: $params[0] === 'logboek'
$pagina = $params[1] ?? '';
$actie = $params[2] ?? '';
$id = $params[3] ?? null;

switch ($pagina) {

    case 'logs':              // localhost:8888/logboek/logs
    default:
        require_once "model/logFunctions.php";
        switch ($actie) {
            case 'upsert':          // localhost:8888/logboek/logs/upsert
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (!empty($_POST['id'])) {
                        updateLog($_POST);
                    } else {
                        createLog($_POST);
                    }
                }
                header("Location: /logboek/logs/overzicht");
                exit;
            case 'delete':
                // URL voorbeeld: /logboek/logs/delete/1
                if (isset($id)) {
                    deleteLog($id);
                }
                header("Location: /logboek/logs/overzicht");
                exit;
            case 'edit':
                // URL voorbeeld: /logboek/logs/edit/1
                $editLog = new Log();  // Maakt nieuw object aan van Log()
                if (isset($id)) {
                    $editLog = getLog($id);
                }
                $logs = getLogs();
                require "view/home.php";
                break;
            case 'overzicht':
            default:
                $editLog = new Log();
                $logs = getLogs();
                require "view/home.php";
        }
}

