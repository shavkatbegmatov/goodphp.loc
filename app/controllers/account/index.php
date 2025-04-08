<?php

if (!currentUser()) {
    redirect('/account/login');
}

$title = 'Учетная запись';