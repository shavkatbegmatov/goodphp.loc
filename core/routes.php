<?php

get('/', function() {
    run('index');
});

get('/account', function() {
    run('account/index');
});

get('/account/login', function() {
    run('account/login');
});

get('/account/settings/password', function() {
    run('account/settings/password');
});

get('/account/logout', function() {
    run('account/logout');
});

get('/users', function() {
    run('user/index');
});

get('/user/create', function() {
    run('user/create');
});

get('/user/delete/:id', function($id) {
    run('user/delete', ['id' => $id]);
});

get('/user/assign_roles/:id', function($id) {
    run('user/assign_roles', ['id' => $id]);
});

get('/modules', function() {
    run('module/index');
});

get('/module/create', function() {
    run('module/create');
});

get('/module/delete/:id', function($id) {
    run('module/delete', ['id' => $id]);
});

get('/permissions', function() {
    run('permission/index');
});

get('/permission/create', function() {
    run('permission/create');
});

get('/permission/delete/:id', function($id) {
    run('permission/delete', ['id' => $id]);
});

get('/roles', function() {
    run('role/index');
});

get('/role/create', function() {
    run('role/create');
});

get('/role/delete/:id', function($id) {
    run('role/delete', ['id' => $id]);
});

get('/role/assign_permissions/:id', function($id) {
    run('role/assign_permissions', ['id' => $id]);
});

get('/questions', function() {
    run('question/index');
});

get('/question/create', function() {
    run('question/create');
});

get('/question/delete/:id', function($id) {
    run('question/delete', ['id' => $id]);
});

get('/question/answer_options/:id', function($id) {
    run('question/answer_options', ['id' => $id]);
});

get('/questionnaires', function() {
    run('questionnaire/index');
});

get('/questionnaire/create', function() {
    run('questionnaire/create');
});

get('/questionnaire/delete/:id', function($id) {
    run('questionnaire/delete', ['id' => $id]);
});

get('/questionnaire/edit/:id', function($id) {
    run('questionnaire/edit', ['id' => $id]);
});

get('*', function() {
    run('errors/404');
});