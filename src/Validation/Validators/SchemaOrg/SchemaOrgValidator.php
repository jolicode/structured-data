<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators\SchemaOrg;

use Jolicode\JsonLd\Validation\Validators\ValidationResult;
use Jolicode\JsonLd\Validation\Validators\ValidatorInterface;

class SchemaOrgValidator implements ValidatorInterface
{
    public static function validateTypeProperty(string $propertyLabel, string $typeLabel): ValidationResult
    {
        $typeFqcn = self::getTypeFqcn($typeLabel);

        if (!class_exists($typeFqcn)) {
            $message = sprintf('This type is not a valid Schema.org type: %s', $typeLabel);

            return new ValidationResult(isValid: false, message: $message);
        }

        if (!self::propertyTypeIsValid($propertyLabel, $typeFqcn)) {
            $message = sprintf('The "%s" property does not accept the "%s" type as a value in Schema.org', $propertyLabel, $typeFqcn::LABEL);

            return new ValidationResult(isValid: false, message: $message);
        }

        return new ValidationResult(isValid: true);
    }

    public static function validateRegularProperty(string $propertyLabel, string $typeLabel): ValidationResult
    {
        $propertyFqcn = self::getPropertyFqcn($propertyLabel);
        $typeFqcn = self::getTypeFqcn($typeLabel);

        if (!class_exists($propertyFqcn)) {
            $message = sprintf('This property does not exist in Schema.org: %s', $propertyLabel);

            return new ValidationResult(isValid: false, message: $message);
        }

        if (!property_exists($typeFqcn, $propertyLabel)) {
            $message = sprintf('The property "%s" does not exist on the type "%s" in Schema.org', $propertyLabel, $typeLabel);

            return new ValidationResult(isValid: false, message: $message);
        }

        return new ValidationResult(isValid: true);
    }

    private static function getTypeFqcn(string $typeShortName): string
    {
        return sprintf('SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    private static function getPropertyFqcn(string $propertyShortName): string
    {
        return sprintf('SchemaOrg\\Property\\%sModel', ucfirst($propertyShortName));
    }

    private static function propertyTypeIsValid(string $propertyLabel, string $typeFqcn): bool
    {
        if (!\in_array($typeFqcn, self::getPropertyFqcn($propertyLabel)::VALUES, true)) {
            foreach ($typeFqcn::PARENTS as $parentType) {
                if (self::propertyTypeIsValid($propertyLabel, $parentType)) {
                    return true;
                }
            }

            return false;
        }

        return true;
    }
}
