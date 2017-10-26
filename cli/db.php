<?php
define("SHA",false);
require_once 'config.php';
require_once 'dbc/DB.php';
function db(){
        $active_group = 'default';
        $query_builder = TRUE;
        $db['default'] = array(
            'dsn'   => DNS,
            'hostname' => HOST,
            'username' => USERNAME,
            'password' => PASSWORD,
            'database' => DATABASE,
            'dbdriver' => DATABASE_TYPE,
            'dbprefix' => DATABASE_PREFIX,
            'pconnect' => FALSE,
            'db_debug' => (ENVIRONMENT !== 'production'),
            'cache_on' => FALSE,
            'cachedir' => '',
            'char_set' => 'utf8',
            'dbcollat' => 'utf8_general_ci',
            'swap_pre' => '',
            'encrypt' => FALSE,
            'compress' => FALSE,
            'stricton' => FALSE,
            'failover' => array(),
            'save_queries' => TRUE
        );
        return DBC($db['default']);
}
