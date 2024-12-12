<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class ReportageNewsArticleModel
{
    public const DESCRIPTION = 'The [[ReportageNewsArticle]] type is a subtype of [[NewsArticle]] representing
 news articles which are the result of journalistic news reporting conventions.

In practice many news publishers produce a wide variety of article types, many of which might be considered a [[NewsArticle]] but not a [[ReportageNewsArticle]]. For example, opinion pieces, reviews, analysis, sponsored or satirical articles, or articles that combine several of these elements.

The [[ReportageNewsArticle]] type is based on a stricter ideal for "news" as a work of journalism, with articles based on factual information either observed or verified by the author, or reported and verified from knowledgeable sources.  This often includes perspectives from multiple viewpoints on a particular issue (distinguishing news reports from public relations or propaganda).  News reports in the [[ReportageNewsArticle]] sense de-emphasize the opinion of the author, with commentary and value judgements typically expressed elsewhere.

A [[ReportageNewsArticle]] which goes deeper into analysis can also be marked with an additional type of [[AnalysisNewsArticle]].
';
    public const LABEL = 'ReportageNewsArticle';
    public const NAME = 'schema:ReportageNewsArticle';
    public const PARENTS = ['NewsArticleModel' => 'Jolicode\SchemaOrg\Type\NewsArticleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AboutModel $about = null,
        public ?Property\AbstractModel $abstract = null,
        public ?Property\AccessModeModel $accessMode = null,
        public ?Property\AccessModeSufficientModel $accessModeSufficient = null,
        public ?Property\AccessibilityAPIModel $accessibilityAPI = null,
        public ?Property\AccessibilityControlModel $accessibilityControl = null,
        public ?Property\AccessibilityFeatureModel $accessibilityFeature = null,
        public ?Property\AccessibilityHazardModel $accessibilityHazard = null,
        public ?Property\AccessibilitySummaryModel $accessibilitySummary = null,
        public ?Property\AccountablePersonModel $accountablePerson = null,
        public ?Property\AcquireLicensePageModel $acquireLicensePage = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AggregateRatingModel $aggregateRating = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\AlternativeHeadlineModel $alternativeHeadline = null,
        public ?Property\ArchivedAtModel $archivedAt = null,
        public ?Property\ArticleBodyModel $articleBody = null,
        public ?Property\ArticleSectionModel $articleSection = null,
        public ?Property\AssessesModel $assesses = null,
        public ?Property\AssociatedMediaModel $associatedMedia = null,
        public ?Property\AudienceModel $audience = null,
        public ?Property\AudioModel $audio = null,
        public ?Property\AuthorModel $author = null,
        public ?Property\AwardModel $award = null,
        public ?Property\AwardsModel $awards = null,
        public ?Property\BackstoryModel $backstory = null,
        public ?Property\CharacterModel $character = null,
        public ?Property\CitationModel $citation = null,
        public ?Property\CommentModel $comment = null,
        public ?Property\CommentCountModel $commentCount = null,
        public ?Property\ConditionsOfAccessModel $conditionsOfAccess = null,
        public ?Property\ContentLocationModel $contentLocation = null,
        public ?Property\ContentRatingModel $contentRating = null,
        public ?Property\ContentReferenceTimeModel $contentReferenceTime = null,
        public ?Property\ContributorModel $contributor = null,
        public ?Property\CopyrightHolderModel $copyrightHolder = null,
        public ?Property\CopyrightNoticeModel $copyrightNotice = null,
        public ?Property\CopyrightYearModel $copyrightYear = null,
        public ?Property\CorrectionModel $correction = null,
        public ?Property\CountryOfOriginModel $countryOfOrigin = null,
        public ?Property\CreativeWorkStatusModel $creativeWorkStatus = null,
        public ?Property\CreatorModel $creator = null,
        public ?Property\CreditTextModel $creditText = null,
        public ?Property\DateCreatedModel $dateCreated = null,
        public ?Property\DateModifiedModel $dateModified = null,
        public ?Property\DatePublishedModel $datePublished = null,
        public ?Property\DatelineModel $dateline = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DigitalSourceTypeModel $digitalSourceType = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DiscussionUrlModel $discussionUrl = null,
        public ?Property\EditEIDRModel $editEIDR = null,
        public ?Property\EditorModel $editor = null,
        public ?Property\EducationalAlignmentModel $educationalAlignment = null,
        public ?Property\EducationalLevelModel $educationalLevel = null,
        public ?Property\EducationalUseModel $educationalUse = null,
        public ?Property\EncodingModel $encoding = null,
        public ?Property\EncodingFormatModel $encodingFormat = null,
        public ?Property\EncodingsModel $encodings = null,
        public ?Property\ExampleOfWorkModel $exampleOfWork = null,
        public ?Property\ExpiresModel $expires = null,
        public ?Property\FileFormatModel $fileFormat = null,
        public ?Property\FunderModel $funder = null,
        public ?Property\FundingModel $funding = null,
        public ?Property\GenreModel $genre = null,
        public ?Property\HasPartModel $hasPart = null,
        public ?Property\HeadlineModel $headline = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\InLanguageModel $inLanguage = null,
        public ?Property\InteractionStatisticModel $interactionStatistic = null,
        public ?Property\InteractivityTypeModel $interactivityType = null,
        public ?Property\InterpretedAsClaimModel $interpretedAsClaim = null,
        public ?Property\IsAccessibleForFreeModel $isAccessibleForFree = null,
        public ?Property\IsBasedOnModel $isBasedOn = null,
        public ?Property\IsBasedOnUrlModel $isBasedOnUrl = null,
        public ?Property\IsFamilyFriendlyModel $isFamilyFriendly = null,
        public ?Property\IsPartOfModel $isPartOf = null,
        public ?Property\KeywordsModel $keywords = null,
        public ?Property\LearningResourceTypeModel $learningResourceType = null,
        public ?Property\LicenseModel $license = null,
        public ?Property\LocationCreatedModel $locationCreated = null,
        public ?Property\MainEntityModel $mainEntity = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MaintainerModel $maintainer = null,
        public ?Property\MaterialModel $material = null,
        public ?Property\MaterialExtentModel $materialExtent = null,
        public ?Property\MentionsModel $mentions = null,
        public ?Property\NameModel $name = null,
        public ?Property\OffersModel $offers = null,
        public ?Property\PageEndModel $pageEnd = null,
        public ?Property\PageStartModel $pageStart = null,
        public ?Property\PaginationModel $pagination = null,
        public ?Property\PatternModel $pattern = null,
        public ?Property\PositionModel $position = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PrintColumnModel $printColumn = null,
        public ?Property\PrintEditionModel $printEdition = null,
        public ?Property\PrintPageModel $printPage = null,
        public ?Property\PrintSectionModel $printSection = null,
        public ?Property\ProducerModel $producer = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\PublicationModel $publication = null,
        public ?Property\PublisherModel $publisher = null,
        public ?Property\PublisherImprintModel $publisherImprint = null,
        public ?Property\PublishingPrinciplesModel $publishingPrinciples = null,
        public ?Property\RecordedAtModel $recordedAt = null,
        public ?Property\ReleasedEventModel $releasedEvent = null,
        public ?Property\ReviewModel $review = null,
        public ?Property\ReviewsModel $reviews = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SchemaVersionModel $schemaVersion = null,
        public ?Property\SdDatePublishedModel $sdDatePublished = null,
        public ?Property\SdLicenseModel $sdLicense = null,
        public ?Property\SdPublisherModel $sdPublisher = null,
        public ?Property\SizeModel $size = null,
        public ?Property\SourceOrganizationModel $sourceOrganization = null,
        public ?Property\SpatialModel $spatial = null,
        public ?Property\SpatialCoverageModel $spatialCoverage = null,
        public ?Property\SpeakableModel $speakable = null,
        public ?Property\SponsorModel $sponsor = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TeachesModel $teaches = null,
        public ?Property\TemporalModel $temporal = null,
        public ?Property\TemporalCoverageModel $temporalCoverage = null,
        public ?Property\TextModel $text = null,
        public ?Property\ThumbnailModel $thumbnail = null,
        public ?Property\ThumbnailUrlModel $thumbnailUrl = null,
        public ?Property\TimeRequiredModel $timeRequired = null,
        public ?Property\TranslationOfWorkModel $translationOfWork = null,
        public ?Property\TranslatorModel $translator = null,
        public ?Property\TypicalAgeRangeModel $typicalAgeRange = null,
        public ?Property\UrlModel $url = null,
        public ?Property\UsageInfoModel $usageInfo = null,
        public ?Property\VersionModel $version = null,
        public ?Property\VideoModel $video = null,
        public ?Property\WordCountModel $wordCount = null,
        public ?Property\WorkExampleModel $workExample = null,
        public ?Property\WorkTranslationModel $workTranslation = null,
    ) {
    }
}
