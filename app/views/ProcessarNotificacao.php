<?php
// views/NotificationView.php

class NotificationView {
    public static function render($data) {
        header("Content-Type: application/json");
        echo json_encode($data);
    }
}
