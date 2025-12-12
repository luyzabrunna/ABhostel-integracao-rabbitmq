<?php
session_start();
session_unset();
session_destroy();
echo "Sessão apagada! Agora volte para login.php";