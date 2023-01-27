<?php

/**
 * Pinga DB
 *
 * Written in 2023 by Taras Kondratyuk (https://getpinga.com)
 * Based on PHP-DB (https://github.com/delight-im/PHP-DB) by delight.im (https://www.delight.im/)
 *
 * @license MIT
 */

namespace Pinga\Db\Throwable;

/**
 * Error that is thrown when an empty `WHERE` clause is provided
 *
 * Although technically perfectly valid, an empty list of criteria is often provided by mistake
 *
 * This is why, for some operations, it is deemed too dangerous and thus disallowed
 *
 * Usually, one can simply execute a manual statement instead to get rid of this restriction
 */
class EmptyWhereClauseError extends Error {}
