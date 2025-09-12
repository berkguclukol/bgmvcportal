<?php
require_once 'core/database.php';
require_once 'core/factory.php';
require_once 'core/controller.php';
require_once 'core/view.php';
require_once 'core/variables.php';
require_once 'core/system.php';
require_once 'core/helper.php';
require_once 'core/encryption.php';
require_once 'core/sessionmanager.php';
if (USE_DB) :
    $db = new Database();
endif;
