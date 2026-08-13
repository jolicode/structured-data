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

final class EduQuestionTypeModel
{
    public const DESCRIPTION = 'For questions that are part of learning resources (e.g. Quiz), eduQuestionType indicates the format of question being given. Example: "Multiple choice", "Open ended", "Flashcard".';
    public const LABEL = 'eduQuestionType';
    public const NAME = 'schema:eduQuestionType';
    public const VALUES = ['TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Question' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuestionModel', 'SolveMathAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SolveMathActionModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2636'];
    public const SUPERSEDED_BY = null;
}
