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

/** Exception that is thrown when a transaction cannot be rolled back successfully for some reason */
class RollBackTransactionFailureException extends TransactionFailureException {}
