<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generators\Google;

use PhpParser\Node\Expr\Array_;
use PhpParser\PrettyPrinter\Standard;

class PrettyPrinter extends Standard
{
    protected function pExpr_Array(Array_ $node): string
    {
        if (!$this->shouldPrintMultiline($node)) {
            return parent::pExpr_Array($node);
        }

        return '[' . $this->pCommaSeparatedMultiline($node->items, true) . $this->nl . ']';
    }

    private function shouldPrintMultiline(Array_ $node): bool
    {
        if ($node->getAttribute('force_multiline', false)) {
            return true;
        }

        foreach ($node->items as $item) {
            if ($item->key instanceof Array_ || $item->value instanceof Array_) {
                return true;
            }
        }

        return false;
    }
}
