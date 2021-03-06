<?php
declare(strict_types=1);
namespace Neos\EventSourcedContentRepository\Domain\Context\ContentStream\Command;

/*
 * This file is part of the Neos.ContentRepository package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\ContentRepository\Domain\ContentStream\ContentStreamIdentifier;

/**
 * ForkContentStream for creating a new fork of a content stream.
 */
final class ForkContentStream
{
    /**
     * TODO: TargetContentStreamIdentifier??
     *
     * Content stream identifier for the new content stream
     *
     * @var ContentStreamIdentifier
     */
    private $contentStreamIdentifier;

    /**
     * @var ContentStreamIdentifier
     */
    private $sourceContentStreamIdentifier;

    /**
     * ContentStreamWasForked constructor.
     * @param ContentStreamIdentifier $contentStreamIdentifier
     * @param ContentStreamIdentifier $sourceContentStreamIdentifier
     */
    public function __construct(ContentStreamIdentifier $contentStreamIdentifier, ContentStreamIdentifier $sourceContentStreamIdentifier)
    {
        $this->contentStreamIdentifier = $contentStreamIdentifier;
        $this->sourceContentStreamIdentifier = $sourceContentStreamIdentifier;
    }

    public static function fromArray(array $array): self
    {
        return new static(
            ContentStreamIdentifier::fromString($array['contentStreamIdentifier']),
            ContentStreamIdentifier::fromString($array['sourceContentStreamIdentifier'])
        );
    }

    /**
     * @return ContentStreamIdentifier
     */
    public function getContentStreamIdentifier(): ContentStreamIdentifier
    {
        return $this->contentStreamIdentifier;
    }

    /**
     * @return ContentStreamIdentifier
     */
    public function getSourceContentStreamIdentifier(): ContentStreamIdentifier
    {
        return $this->sourceContentStreamIdentifier;
    }
}
