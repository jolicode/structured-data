<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class BorrowerModel
{
    public const DESCRIPTION = 'A sub property of participant. The person that borrows the object being lent.';
    public const LABEL = 'borrower';
    public const NAME = 'schema:borrower';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['LendAction' => 'Jolicode\SchemaOrg\Type\LendActionModel'];
}
