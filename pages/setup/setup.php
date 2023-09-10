<?php
include_once('../pages/setup/setup-views.php');

  if(!checkMySqliExp() || !checkPHP($config['reqsys']['php'])){
    $header = 'Setup error';
    $report = checkMySqliExp() ? "" : "<p>MySqli extension is not installed.</p><br>";
    $report .= checkPHP($config['reqsys']['php']) ? "" : "<p>PHP version not support</p><br>";
    header("Location: ../views/error.php?report=$report&header=$header");
    exit();
}
  if(!isset($config['db']['server']) || !isset($config['db']['user']) || !isset($config['db']['password']) || !isset($config['db']['database']) || $config['sys']['setup'] === true){
    header("Location: ../views/setup.php");
  } else {
    $db = new database();
    $db->setServername($config['db']['server']);
    $db->setUsername($config['db']['user']);
    $db->setPassword($config['db']['password']);
    $db->setDbname($config['db']['database']);
    $db->getconn();
  }

?>