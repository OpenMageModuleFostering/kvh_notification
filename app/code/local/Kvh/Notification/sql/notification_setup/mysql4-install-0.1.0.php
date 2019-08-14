<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('notification')};
CREATE TABLE {$this->getTable('notification')} (
  `notification_id` int(11) unsigned NOT NULL auto_increment,
  `notification_name` varchar(255) NOT NULL default '',
  `notification_content` text,
  `start_date` datetime,
  `end_date` datetime,
  `is_active` smallint(6) default 1,
   PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");

$installer->endSetup(); 