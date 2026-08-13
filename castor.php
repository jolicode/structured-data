<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use function Castor\import;

require_once __DIR__ . '/vendor/autoload.php';

// Every task lives in the ".castor" directory, one file per namespace.
import(__DIR__ . '/.castor');
