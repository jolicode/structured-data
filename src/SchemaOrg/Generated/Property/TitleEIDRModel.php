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

final class TitleEIDRModel
{
    public const DESCRIPTION = 'An [EIDR](https://eidr.org/) (Entertainment Identifier Registry) [[identifier]] representing at the most general/abstract level, a work of film or television.

For example, the motion picture known as "Ghostbusters" has a titleEIDR of  "10.5240/7EC7-228A-510A-053E-CBB8-J". This title (or work) may have several variants, which EIDR calls "edits". See [[editEIDR]].

Since schema.org types like [[Movie]], [[TVEpisode]], [[TVSeason]], and [[TVSeries]] can be used for both works and their multiple expressions, it is possible to use [[titleEIDR]] alone (for a general description), or alongside [[editEIDR]] for a more edit-specific description.
';
    public const LABEL = 'titleEIDR';
    public const NAME = 'schema:titleEIDR';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Movie' => 'Jolicode\SchemaOrg\Type\MovieModel', 'TVEpisode' => 'Jolicode\SchemaOrg\Type\TVEpisodeModel', 'TVSeason' => 'Jolicode\SchemaOrg\Type\TVSeasonModel', 'TVSeries' => 'Jolicode\SchemaOrg\Type\TVSeriesModel'];
}
