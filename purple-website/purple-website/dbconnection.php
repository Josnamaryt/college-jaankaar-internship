<?php

require_once __DIR__ . '/include/Database.php';

function getConnection() {
    static $db = null;
    if ($db === null) {
        $db = new Database();
    }
    return $db->getConnection();
}

?>
