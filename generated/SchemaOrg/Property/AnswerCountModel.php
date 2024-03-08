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

final class AnswerCountModel
{
    public const DESCRIPTION = 'The number of answers this question has received.';
    public const LABEL = 'answerCount';
    public const NAME = 'schema:answerCount';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['Question' => 'SchemaOrg\Type\QuestionModel'];
}
