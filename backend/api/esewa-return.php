<?php

// Dedicated eSewa callback endpoint. eSewa appends payment data to this URL.
session_start();

require_once __DIR__ . '/../controllers/OrderController.php';

(new OrderController())->esewaReturn();
