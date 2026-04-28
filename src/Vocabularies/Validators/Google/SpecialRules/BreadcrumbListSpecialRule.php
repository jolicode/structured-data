<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators\Google\SpecialRules;

use Jolicode\Vocabularies\Mapper\MappedError;
use Jolicode\Vocabularies\Mapper\MappedProperty;
use Jolicode\Vocabularies\Mapper\MappedType;

final class BreadcrumbListSpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.breadcrumb.last_item_optional';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        if ('item' !== ($missingProperty['name'] ?? null)) {
            return false;
        }

        if (!$this->hasType($type->type, 'ListItem')) {
            return false;
        }

        if ('itemListElement' !== $type->parentProperty?->key) {
            return false;
        }

        if (!$this->hasType($this->getRootType($type)->type, 'BreadcrumbList')) {
            return false;
        }

        return $this->isLastItem($type);
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->hasType($type->type, 'BreadcrumbList')) {
            return [];
        }

        $itemListElement = $type->properties['itemListElement'] ?? null;

        if (!$itemListElement instanceof MappedProperty) {
            return [];
        }

        $value = $itemListElement->value;
        $values = \is_array($value) ? $value : [$value];

        $listItems = array_filter(
            $values,
            fn (mixed $item): bool => $item instanceof MappedType && $this->hasType($item->type, 'ListItem'),
        );

        if (\count($listItems) >= 2) {
            return [];
        }

        return [[
            'target' => $itemListElement,
            'message' => 'A "BreadcrumbList" must contain at least 2 "ListItem" entries.',
            'severity' => MappedError::SEVERITY_ERROR,
        ]];
    }

    private function isLastItem(MappedType $type): bool
    {
        $siblings = $type->parentProperty?->value;

        if ($siblings instanceof MappedType) {
            $siblings = [$siblings];
        }

        if (!\is_array($siblings) || [] === $siblings) {
            return false;
        }

        $currentPosition = $this->getListItemPosition($type);

        if (null === $currentPosition) {
            return false;
        }

        $positions = array_filter(
            array_map(
                fn (mixed $sibling): ?int => $sibling instanceof MappedType ? $this->getListItemPosition($sibling) : null,
                $siblings,
            ),
            static fn (?int $position): bool => null !== $position,
        );

        if ([] === $positions) {
            return false;
        }

        $lastPosition = max($positions);

        return $currentPosition === $lastPosition;
    }

    private function getListItemPosition(MappedType $type): ?int
    {
        $position = $type->properties['position']->value ?? null;

        if (\is_int($position)) {
            return $position;
        }

        if (is_numeric($position)) {
            return (int) $position;
        }

        return null;
    }

    private function getRootType(MappedType $type): MappedType
    {
        while ($type->parent) {
            $type = $type->parent;
        }

        return $type;
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }
}
