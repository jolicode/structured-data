<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;

/**
 * Step 5 of the Context Processing algorithm: the context entries that are
 * resolved without loading a remote document.
 *
 * see https://www.w3.org/TR/json-ld-api/#context-processing-algorithm
 */
final class ContextEntryHandler
{
    public static function handleNullContext(Context $activeContext, Context &$result, bool $overrideProtected, bool $propagate): void
    {
        // 5.1.1
        // The check targets the context accumulated so far in the sequence: a
        // protected term introduced by a previous entry of the same local context
        // array also forbids nullification.
        if (!$overrideProtected && $result->hasProtectedTermDefinitions()) {
            throw new ContextProcessingException('invalid context nullification');
        }

        // 5.1.2
        $result = new Context(
            baseIri: $activeContext->baseUrl,
            baseUrl: $activeContext->baseUrl,
            previousContext: false === $propagate ? $result : null,
        );
    }

    public static function handleVersionEntry(Context $activeContext, \stdClass $context): void
    {
        // 5.5.1
        if (1.1 !== (float) $context->{Keyword::VERSION->value}) {
            throw new ContextProcessingException('invalid @version value');
        }

        // 5.5.2
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new ContextProcessingException('processing mode conflict');
        }
    }

    public static function handleBaseEntry(Context &$result, \stdClass $context): void
    {
        $value = $context->{Keyword::BASE->value};

        // 5.7.2
        if (null === $value) {
            $result->baseIri = null;
        // 5.7.4 : we invert 5.7.3 and 5.7.4 because it doesn't make sense to do it the other way around
        } elseif (IriResolver::isRelativeIri($value) && $result->baseIri) {
            $result->baseIri = IriResolver::resolveIri($result->baseIri, $value);
        // 5.7.3
        } elseif (IriResolver::isIri($value)) {
            $result->baseIri = $value;
        // 5.7.5
        } else {
            throw new ContextProcessingException('invalid base IRI');
        }
    }

    public static function handleVocabEntry(Context $activeContext, Context &$result, \stdClass $context): void
    {
        // 5.8.1
        $value = $context->{Keyword::VOCAB->value};

        // 5.8.2
        if (null === $value) {
            $result->vocabularyMapping = null;
        // In JSON-LD 1.0, relative @vocab mappings are invalid, including the empty string.
        } elseif (
            Context::PROCESSING_MODE_10 === $activeContext->processingMode
            && ('' === $value || (!IriResolver::isAbsoluteIri($value) && !IriResolver::isBlankNodeIdentifier($value)))
        ) {
            throw new ContextProcessingException('invalid vocab mapping');
        // 5.8.3
        } elseif ('' !== $value && !IriResolver::isIri($value) && !IriResolver::isBlankNodeIdentifier($value)) {
            throw new ContextProcessingException('invalid vocab mapping');
        } else {
            $result->vocabularyMapping = IriResolver::expand($result, $value, true);
        }
    }

    public static function handleLanguageEntry(Context &$result, \stdClass $context): void
    {
        // 5.9.1
        $value = $context->{Keyword::LANGUAGE->value};

        // 5.9.2
        if (!$value) {
            $result->defaultLangage = null;
        // 5.9.3
        } elseif (\is_string($value)) {
            $result->defaultLangage = $value;
        } else {
            throw new ContextProcessingException('invalid default language');
        }
    }

    public static function handleDirectionEntry(Context $activeContext, Context &$result, \stdClass $context): void
    {
        // 5.10.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new ContextProcessingException('invalid context entry');
        }

        // 5.10.2
        $value = $context->{Keyword::DIRECTION->value};

        // 5.10.3
        if (!$value) {
            $result->defaultBaseDirection = null;
        // 5.10.4
        } elseif (!\is_string($value) || !\in_array($value, ['ltr', 'rtl'], true)) {
            throw new ContextProcessingException('invalid base direction');
        } else {
            $result->defaultBaseDirection = $value;
        }
    }

    public static function handlePropagateEntry(Context $activeContext, \stdClass $context): void
    {
        // 5.11.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new ContextProcessingException('invalid context entry');
        }

        // 5.11.2
        if (!\is_bool($context->{Keyword::PROPAGATE->value})) {
            throw new ContextProcessingException('invalid @propagate value');
        }
    }
}
