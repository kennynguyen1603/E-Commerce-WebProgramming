<!-- File cấu hình chính (DB connection, session, etc.) -->
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
