<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Audit;

use JoliCode\StructuredData\Mapper\MappedType;

/**
 * One node of the audited document, as a consumer of the structured data sees it.
 *
 * When the blocks sharing an identifier are merged (the default, as Google does),
 * an item holds the node built from all of them, and the blocks it comes from.
 * Otherwise, and for a block sharing its identifier with no other, the item is the
 * block itself.
 */
final readonly class Item
{
    /**
     * @param list<MappedType> $sources
     */
    public function __construct(
        private MappedType $type,
        private array $sources,
        private ?string $identifier = null,
    ) {
    }

    /**
     * The node, with the diagnostics that make the verdict of the item: the
     * merged node for a merged item, the block itself otherwise.
     */
    public function getType(): MappedType
    {
        return $this->type;
    }

    /**
     * The blocks of the document the item comes from, in document order, each
     * with its source format, its positions and its own diagnostics: a block of a
     * merged item is audited as if it were alone, so it may report a property
     * another block provides.
     *
     * @return list<MappedType>
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * The absolute identifier ("@id", "itemid") of the node, if it has one.
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function isMerged(): bool
    {
        return isset($this->sources[1]);
    }
}
