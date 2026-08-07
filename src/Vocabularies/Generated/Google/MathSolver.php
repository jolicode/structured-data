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

final class MathSolver
{
    public const SUPPORTED_TYPES = ['MathSolver'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/math-solvers';
    public const SPECIAL_RULE_KEYS = [];
    public const PROPERTIES = [
        'name' => [
            'name' => 'name',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'required',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'learningResourceType' => [
            'name' => 'learningResourceType',
            'severity' => 'required',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'potentialAction' => [
            'name' => 'potentialAction',
            'severity' => 'required',
            'supportedTypes' => [
                'SolveMathAction',
            ],
            'properties' => [
                'target' => [
                    'name' => 'target',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
                'mathExpression-input' => [
                    'name' => 'mathExpression-input',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'eduQuestionType' => [
                    'name' => 'eduQuestionType',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'usageInfo' => [
            'name' => 'usageInfo',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'inLanguage' => [
            'name' => 'inLanguage',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
    ];
}
