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

final class ParentItemModel
{
    public const DESCRIPTION = 'The parent of a question, answer or item in general. Typically used for Q/A discussion threads e.g. a chain of comments with the first comment being an [[Article]] or other [[CreativeWork]]. See also [[comment]] which points from something to a comment about it.';
    public const LABEL = 'parentItem';
    public const NAME = 'schema:parentItem';
    public const VALUES = ['CommentModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CommentModel', 'CreativeWorkModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['Answer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnswerModel', 'Comment' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CommentModel', 'Question' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuestionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
