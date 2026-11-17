<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Website\Twig;

use JoliCode\StructuredData\JsonLd\Parser\Range;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class JsonLdExtension extends AbstractExtension
{
    #[\Override]
    public function getFilters(): array
    {
        return [
            new TwigFilter('isTypeProperty', $this->isTypeProperty(...)),
            new TwigFilter('renderScalarValue', $this->renderScalarValue(...)),
        ];
    }

    #[\Override]
    public function getFunctions(): array
    {
        return [
            new TwigFunction('formatRanges', $this->formatRanges(...)),
        ];
    }

    private function isTypeProperty(MappedProperty|MappedType $property): bool
    {
        if ($property instanceof MappedType) {
            return false;
        }

        if ($property->getValue() instanceof MappedType) {
            return true;
        }

        return \is_array($property->getValue()) && array_any($property->getValue(), static fn (mixed $value): bool => $value instanceof MappedType);
    }

    /**
     * @param Range[]       $ranges
     * @param 'end'|'start' $position
     */
    private function formatRanges(array $ranges, string $position): string
    {
        return implode('|', array_map(
            static fn (Range $range): string => $range->{$position},
            $ranges,
        ));
    }

    private function renderScalarValue(mixed $value): string
    {
        if (\is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (!\is_string($value)) {
            return (string) $value;
        }

        // The values extracted from the document may still carry JSON escape
        // sequences (\uXXXX, \"…): they are decoded for display only, and the
        // raw value is kept when the result is not a valid JSON string.
        $decoded = json_decode('"' . str_replace('"', '\"', $value) . '"', true);

        return \is_string($decoded) ? $decoded : $value;
    }
}
