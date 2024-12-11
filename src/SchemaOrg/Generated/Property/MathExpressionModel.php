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

final class MathExpressionModel
{
    public const DESCRIPTION = 'A mathematical expression (e.g. \'x^2-3x=0\') that may be solved for a specific variable, simplified, or transformed. This can take many formats, e.g. LaTeX, Ascii-Math, or math as you would write with a keyboard.';
    public const LABEL = 'mathExpression';
    public const NAME = 'schema:mathExpression';
    public const VALUES = ['SolveMathActionModel' => 'Jolicode\SchemaOrg\Type\SolveMathActionModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MathSolver' => 'Jolicode\SchemaOrg\Type\MathSolverModel'];
}
