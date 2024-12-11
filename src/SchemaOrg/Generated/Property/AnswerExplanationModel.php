<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class AnswerExplanationModel
{
    public const DESCRIPTION = 'A step-by-step or full explanation about Answer. Can outline how this Answer was achieved or contain more broad clarification or statement about it. ';
    public const LABEL = 'answerExplanation';
    public const NAME = 'schema:answerExplanation';
    public const VALUES = ['CommentModel' => 'Jolicode\SchemaOrg\Type\CommentModel', 'WebContentModel' => 'Jolicode\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['Answer' => 'Jolicode\SchemaOrg\Type\AnswerModel'];
}
