<?php
$query = $this->db->query( "SHOW COLUMNS FROM `" . DB_PREFIX . "customer_reward` LIKE 'note'" );
$exist_note_field = ($query->num_rows > 0) ? true : false;
if(!$exist_note_field){
    $query = $this->db->query( "ALTER TABLE `" . DB_PREFIX . "customer_reward` ADD COLUMN `note` VARCHAR(20) NOT NULL DEFAULT '' AFTER `date_added`" );
}