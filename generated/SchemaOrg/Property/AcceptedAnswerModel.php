<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AcceptedAnswerModel
{
    public const DESCRIPTION = 'The answer(s) that has been accepted as best, typically on a Question/Answer site. Sites vary in their selection mechanisms, e.g. drawing on community opinion and/or the view of the Question author.';
    public const LABEL = 'acceptedAnswer';
    public const NAME = 'schema:acceptedAnswer';
    public const VALUES = ['AnswerModel' => 'SchemaOrg\\Type\\AnswerModel', 'ItemListModel' => 'SchemaOrg\\Type\\ItemListModel'];
    public const TYPES = ['Question' => 'SchemaOrg\\Type\\QuestionModel'];
}
