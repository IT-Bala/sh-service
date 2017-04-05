<?php

defined('SHA') OR exit('Access Denied');

/**
 * ODBC Utility Class
 *
 * @package		CodeIgniter
 * @subpackage	Drivers
 * @category	Database
 * @author		Soava Lab Core Team
 * @link		https://codeigniter.com/database/
 */
class CI_DB_odbc_utility extends CI_DB_utility {

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
