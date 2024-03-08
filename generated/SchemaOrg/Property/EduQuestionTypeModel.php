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

final class EduQuestionTypeModel
{
    public const DESCRIPTION = 'For questions that are part of learning resources (e.g. Quiz), eduQuestionType indicates the format of question being given. Example: "Multiple choice", "Open ended", "Flashcard".';
    public const LABEL = 'eduQuestionType';
    public const NAME = 'schema:eduQuestionType';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Question' => 'SchemaOrg\Type\QuestionModel', 'SolveMathAction' => 'SchemaOrg\Type\SolveMathActionModel'];
}
