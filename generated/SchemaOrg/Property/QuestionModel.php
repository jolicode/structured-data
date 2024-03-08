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

final class QuestionModel
{
    public const DESCRIPTION = 'A sub property of object. A question.';
    public const LABEL = 'question';
    public const NAME = 'schema:question';
    public const VALUES = ['QuestionModel' => 'SchemaOrg\Type\QuestionModel'];
    public const TYPES = ['AskAction' => 'SchemaOrg\Type\AskActionModel'];
}
