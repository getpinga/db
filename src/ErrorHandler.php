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

use PDOException;
use Pinga\Db\Throwable\DatabaseNotFoundError;
use Pinga\Db\Throwable\Error;
use Pinga\Db\Throwable\Exception;
use Pinga\Db\Throwable\IntegrityConstraintViolationException;
use Pinga\Db\Throwable\NoDatabaseSelectedError;
use Pinga\Db\Throwable\SyntaxError;
use Pinga\Db\Throwable\TableNotFoundError;
use Pinga\Db\Throwable\UnknownColumnError;
use Pinga\Db\Throwable\WrongCredentialsError;

/**
 * Handles, processes and re-throws exceptions and errors
 *
 * For more information about possible exceptions and errors, see:
 *
 * https://en.wikibooks.org/wiki/Structured_Query_Language/SQLSTATE
 *
 * https://dev.mysql.com/doc/refman/5.5/en/error-messages-server.html
 */
final class ErrorHandler {

	/**
	 * Handles the specified exception thrown by PDO and tries to throw a more specific exception or error instead
	 *
	 * @param PDOException $e the exception thrown by PDO
	 * @throws Exception
	 * @throws Error
	 */
	public static function rethrow(PDOException $e) {
		// the 2-character class of the error (if any) has the highest priority
		$errorClass = null;
		// the 3-character subclass of the error (if any) has a medium priority
		$errorSubClass = null;
		// the full error code itself has the lowest priority
		$error = null;

		// if an error code is available
		if (!empty($e->getCode())) {
			// remember the error code
			$error = $e->getCode();

			// if the error code is an "SQLSTATE" error
			if (strlen($e->getCode()) === 5) {
				// remember the class as well
				$errorClass = substr($e->getCode(), 0, 2);
				// and remember the subclass
				$errorSubClass = substr($e->getCode(), 2);
			}
		}

		if ($errorClass === '3D') {
			throw new NoDatabaseSelectedError($e->getMessage());
		}
		elseif ($errorClass === '23') {
			throw new IntegrityConstraintViolationException($e->getMessage());
		}
		elseif ($errorClass === '42') {
			if ($errorSubClass === 'S02') {
				throw new TableNotFoundError($e->getMessage());
			}
			elseif ($errorSubClass === 'S22') {
				throw new UnknownColumnError($e->getMessage());
			}
			else {
				throw new SyntaxError($e->getMessage());
			}
		}
		else {
			if ($error === 1044) {
				throw new WrongCredentialsError($e->getMessage());
			}
			elseif ($error === 1049) {
				throw new DatabaseNotFoundError($e->getMessage());
			}
			else {
				throw new Error($e->getMessage());
			}
		}
	}

}
