<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class Quiz
{
    public const NAME = 'Quiz';
    public const SUPPORTED_TYPES = ['Quiz'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/education-qa';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = false;
    public const SPECIAL_RULE_KEYS = [];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = ['hasPart' => ['name' => 'hasPart', 'severity' => 'required', 'supportedTypes' => ['Question'], 'properties' => ['acceptedAnswer' => ['name' => 'acceptedAnswer', 'severity' => 'required', 'supportedTypes' => ['Answer'], 'properties' => ['text' => ['name' => 'text', 'severity' => 'required', 'supportedTypes' => ['Text']]]], 'eduQuestionType' => ['name' => 'eduQuestionType', 'severity' => 'required', 'supportedTypes' => ['Text'], 'value' => ['Flashcard']], 'text' => ['name' => 'text', 'severity' => 'required', 'supportedTypes' => ['Text']]]], 'about' => ['name' => 'about', 'severity' => 'recommended', 'supportedTypes' => ['Thing'], 'properties' => ['name' => ['name' => 'name', 'severity' => 'recommended', 'supportedTypes' => ['Text']]]], 'educationalAlignment' => ['name' => 'educationalAlignment', 'severity' => 'recommended', 'supportedTypes' => ['AlignmentObject'], 'properties' => ['alignmentType' => ['name' => 'alignmentType', 'severity' => 'recommended', 'supportedTypes' => ['Text'], 'value' => ['educationalSubject', 'educationalLevel']], 'targetName' => ['name' => 'targetName', 'severity' => 'recommended', 'supportedTypes' => ['Text']]]]];
}
