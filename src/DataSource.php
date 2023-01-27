<?php

/**
 * Pinga DB
 *
 * Written in 2023 by Taras Kondratyuk (https://getpinga.com)
 * Based on PHP-DB (https://github.com/delight-im/PHP-DB) by delight.im (https://www.delight.im/)
 *
 * @license MIT
 */

namespace Pinga\Db;

/** Description of a data source */
interface DataSource {

	/**
	 * Converts this instance to a DSN
	 *
	 * @return Dsn
	 */
	public function toDsn();

}
