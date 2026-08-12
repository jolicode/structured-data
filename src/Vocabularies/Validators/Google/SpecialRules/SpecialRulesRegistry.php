<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\Google\SpecialRules;

final class SpecialRulesRegistry
{
    private const RULE_CLASS_SUFFIX = 'SpecialRule';

    /**
     * @var array<string, SpecialRuleInterface>|null
     */
    private static ?array $rulesByKey = null;

    /**
     * @param array<string> $keys
     *
     * @return array<SpecialRuleInterface>
     */
    public static function forKeys(array $keys): array
    {
        $rules = [];

        foreach ($keys as $key) {
            $rule = self::allIndexed()[$key] ?? null;

            if (null === $rule) {
                throw new \RuntimeException(\sprintf('Unknown Google special rule key "%s".', $key));
            }

            $rules[] = $rule;
        }

        return $rules;
    }

    /**
     * @return array<string, SpecialRuleInterface>
     */
    public static function allIndexed(): array
    {
        if (null !== self::$rulesByKey) {
            return self::$rulesByKey;
        }

        $rulesByKey = [];
        $pattern = __DIR__ . '/*' . self::RULE_CLASS_SUFFIX . '.php';

        foreach (glob($pattern) ?: [] as $ruleFile) {
            $className = pathinfo($ruleFile, \PATHINFO_FILENAME);

            if (self::RULE_CLASS_SUFFIX === $className) {
                continue;
            }

            $fqcn = __NAMESPACE__ . '\\' . $className;

            if (!class_exists($fqcn)) {
                continue;
            }

            if (!is_subclass_of($fqcn, SpecialRuleInterface::class)) {
                continue;
            }

            $key = $fqcn::getKey();

            if ('' === trim($key)) {
                throw new \RuntimeException(\sprintf('Google special rule class "%s" returned an empty key.', $fqcn));
            }

            if (\array_key_exists($key, $rulesByKey)) {
                throw new \RuntimeException(\sprintf('Duplicate Google special rule key "%s".', $key));
            }

            $rulesByKey[$key] = new $fqcn();
        }

        self::$rulesByKey = $rulesByKey;

        return self::$rulesByKey;
    }
}
