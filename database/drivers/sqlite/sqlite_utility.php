<?php

defined('SHA') OR exit('Access Denied');

/**
 * SQLite Utility Class
 *
 * @category	Database
 * @author		Soava Lab Core Team
 * @link		http://phpbala.in/sh/docs/
 */
class CI_DB_sqlite_utility extends CI_DB_utility {

	/**
	 * Export
	 *
	 * @param	array	$params	Preferences
	 * @return	mixed
	 */
	protected function _backup($params = array())
	{
		// Currently unsupported
		return $this->db->display_error('db_unsupported_feature');
	}

}
