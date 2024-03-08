<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class CutoffTimeModel
{
    public const DESCRIPTION = 'Order cutoff time allows merchants to describe the time after which they will no longer process orders received on that day. For orders processed after cutoff time, one day gets added to the delivery time estimate. This property is expected to be most typically used via the [[ShippingRateSettings]] publication pattern. The time is indicated using the ISO-8601 Time format, e.g. "23:30:00-05:00" would represent 6:30 pm Eastern Standard Time (EST) which is 5 hours behind Coordinated Universal Time (UTC).';
    public const LABEL = 'cutoffTime';
    public const NAME = 'schema:cutoffTime';
    public const VALUES = ['TimeModel' => 'SchemaOrg\Type\TimeModel'];
    public const TYPES = ['ShippingDeliveryTime' => 'SchemaOrg\Type\ShippingDeliveryTimeModel'];
}
