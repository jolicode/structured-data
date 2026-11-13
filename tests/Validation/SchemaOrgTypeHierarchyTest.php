<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrgTypeHierarchy;
use PHPUnit\Framework\TestCase;

class SchemaOrgTypeHierarchyTest extends TestCase
{
    public function testItListsTheTypeThenItsAncestorsNearestFirst(): void
    {
        $this->assertSame(['BusinessEvent', 'Event', 'Thing'], SchemaOrgTypeHierarchy::selfAndAncestors('BusinessEvent'));
        $this->assertSame(['Restaurant', 'FoodEstablishment', 'LocalBusiness', 'Organization', 'Place', 'Thing'], SchemaOrgTypeHierarchy::selfAndAncestors('Restaurant'));
    }

    public function testItOrdersTheSupertypesOfTheSameDistanceAlphabetically(): void
    {
        // LocalBusiness is both an Organization and a Place.
        $this->assertSame(['LocalBusiness', 'Organization', 'Place', 'Thing'], SchemaOrgTypeHierarchy::selfAndAncestors('LocalBusiness'));
    }

    public function testATypeTheVocabularyDoesNotKnowHasNoAncestor(): void
    {
        $this->assertSame(['NotASchemaOrgType'], SchemaOrgTypeHierarchy::selfAndAncestors('NotASchemaOrgType'));
    }

    public function testIsAMatchesTheTypeItselfAndItsAncestors(): void
    {
        $this->assertTrue(SchemaOrgTypeHierarchy::isA('Event', ['Event']));
        $this->assertTrue(SchemaOrgTypeHierarchy::isA('BroadcastEvent', ['PublicationEvent']));
        $this->assertTrue(SchemaOrgTypeHierarchy::isA('Restaurant', ['LocalBusiness', 'Event']));
        $this->assertFalse(SchemaOrgTypeHierarchy::isA('Person', ['Organization']));
        $this->assertFalse(SchemaOrgTypeHierarchy::isA('Event', ['BusinessEvent']));
    }
}
