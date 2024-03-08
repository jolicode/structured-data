<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class MerchantReturnLinkModel
{
    public const DESCRIPTION = 'Specifies a Web page or service by URL, for product returns.';
    public const LABEL = 'merchantReturnLink';
    public const NAME = 'schema:merchantReturnLink';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'SchemaOrg\\Type\\MerchantReturnPolicyModel'];
}
