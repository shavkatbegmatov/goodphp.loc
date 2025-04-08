<?php

if (currentUser()) {
    unset($_SESSION['user']);
}

redirect('/account/login');