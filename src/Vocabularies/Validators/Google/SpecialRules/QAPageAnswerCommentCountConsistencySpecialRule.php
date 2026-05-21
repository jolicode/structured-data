<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators\Google\SpecialRules;

use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedType;

final class QAPageAnswerCommentCountConsistencySpecialRule implements SpecialRuleInterface
{
    public static function getKey(): string
    {
        return 'google.qapage.answer_comment_count_consistency';
    }

    public function shouldIgnoreMissingRequiredProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function shouldIgnoreMissingRecommendedProperty(MappedType $type, array $missingProperty): bool
    {
        return false;
    }

    public function getTypeViolations(MappedType $type): array
    {
        if (!$this->isQAPageQuestion($type)) {
            return [];
        }

        $answerCount = $this->toInt($type->getProperty('answerCount')?->getValue());
        $commentCount = $this->toInt($type->getProperty('commentCount')?->getValue());

        if (null === $answerCount || null === $commentCount) {
            return [];
        }

        $markedAnswerCount = $this->countAnswers($type);
        $markedCommentCount = $this->countQuestionComments($type);
        $markedReplyCount = $markedAnswerCount + $markedCommentCount;

        $declaredReplyCount = $answerCount + $commentCount;

        if ($declaredReplyCount >= $markedReplyCount && $answerCount >= $markedAnswerCount) {
            return [];
        }

        return [[
            'target' => $type,
            'message' => \sprintf(
                'Consistency hint: "answerCount" (%d) + "commentCount" (%d) should be at least the number of marked-up replies (%d answers/comments total).',
                $answerCount,
                $commentCount,
                $markedReplyCount,
            ),
            'severity' => MappedError::SEVERITY_WARNING,
        ]];
    }

    private function isQAPageQuestion(MappedType $type): bool
    {
        if (!$this->hasType($type->getType(), 'Question')) {
            return false;
        }

        if ('mainEntity' !== $type->getParentProperty()?->getKey()) {
            return false;
        }

        return $this->hasType($this->getRootType($type)->getType(), 'QAPage');
    }

    private function countAnswers(MappedType $question): int
    {
        return $this->countMappedTypes($question->getProperty('acceptedAnswer')?->getValue())
            + $this->countMappedTypes($question->getProperty('suggestedAnswer')?->getValue());
    }

    private function countQuestionComments(MappedType $question): int
    {
        return $this->countMappedTypes($question->getProperty('comment')?->getValue());
    }

    private function countMappedTypes(mixed $value): int
    {
        $items = \is_array($value) ? $value : [$value];

        return \count(array_filter($items, static fn (mixed $item): bool => $item instanceof MappedType));
    }

    private function getRootType(MappedType $type): MappedType
    {
        while ($type->getParent()) {
            $type = $type->getParent();
        }

        return $type;
    }

    private function hasType(string|array|null $type, string $searchedType): bool
    {
        if (\is_array($type)) {
            return \in_array($searchedType, $type, true);
        }

        return $searchedType === $type;
    }

    private function toInt(mixed $value): ?int
    {
        if (\is_int($value)) {
            return $value;
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        return null;
    }
}
