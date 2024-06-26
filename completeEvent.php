<?php
    session_cache_expire(30);
    session_start();

    if ($_SESSION['system_type'] == 'MedTracker') {
        if ($_SESSION['access_level'] < 2 || $_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: index.php');
            die();
        }
        require_once('database/dbAppointments.php');
        require_once('include/input-validation.php');
        $args = sanitize($_POST);
        $id = $args['id'];
        if (!$id) {
            header('Location: index.php');
            die();
        }
        if (complete_event($id)) {
            header('Location: calendar.php?completeSuccess');
            die();
        }
        header('Location: index.php');
    } else {
        if ($_SESSION['access_level'] < 2 || $_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: index.php');
            die();
        }
        require_once('database/dbEvents.php');
        require_once('include/input-validation.php');
        $args = sanitize($_POST);
        $id = $args['id'];
        if (!$id) {
            header('Location: VMS_index.php');
            die();
        }
        if (complete_event($id)) {
            header('Location: calendar.php?completeSuccess');
            die();
        }
        header('Location: VMS_index.php');

    }
?>