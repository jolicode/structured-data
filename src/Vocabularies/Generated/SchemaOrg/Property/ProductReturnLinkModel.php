<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ProductReturnLinkModel
{
    public const DESCRIPTION = 'Indicates a Web page or service by URL, for product return.';
    public const LABEL = 'productReturnLink';
    public const NAME = 'schema:productReturnLink';
    public const VALUES = ['URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ProductReturnPolicy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductReturnPolicyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2288'];
    public const SUPERSEDED_BY = 'merchantReturnLink';
}
