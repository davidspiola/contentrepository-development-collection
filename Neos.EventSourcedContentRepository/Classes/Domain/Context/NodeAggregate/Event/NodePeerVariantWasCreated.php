<?php
declare(strict_types=1);
namespace Neos\EventSourcedContentRepository\Domain\Context\NodeAggregate\Event;

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
use Neos\ContentRepository\DimensionSpace\DimensionSpace\DimensionSpacePointSet;
use Neos\ContentRepository\Domain\NodeAggregate\NodeAggregateIdentifier;
use Neos\EventSourcedContentRepository\Domain\Context\NodeAggregate\OriginDimensionSpacePoint;
use Neos\EventSourcing\Event\DomainEventInterface;
use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Proxy(false)
 */
final class NodePeerVariantWasCreated implements DomainEventInterface, PublishableToOtherContentStreamsInterface
{
    /**
     * @var ContentStreamIdentifier
     */
    private $contentStreamIdentifier;

    /**
     * @var NodeAggregateIdentifier
     */
    private $nodeAggregateIdentifier;

    /**
     * @var OriginDimensionSpacePoint
     */
    private $sourceOrigin;

    /**
     * @var OriginDimensionSpacePoint
     */
    private $peerOrigin;

    /**
     * @var DimensionSpacePointSet
     */
    private $peerCoverage;

    public function __construct(
        ContentStreamIdentifier $contentStreamIdentifier,
        NodeAggregateIdentifier $nodeAggregateIdentifier,
        OriginDimensionSpacePoint $sourceOrigin,
        OriginDimensionSpacePoint $peerOrigin,
        DimensionSpacePointSet $peerCoverage
    ) {
        $this->contentStreamIdentifier = $contentStreamIdentifier;
        $this->nodeAggregateIdentifier = $nodeAggregateIdentifier;
        $this->sourceOrigin = $sourceOrigin;
        $this->peerOrigin = $peerOrigin;
        $this->peerCoverage = $peerCoverage;
    }

    /**
     * @return ContentStreamIdentifier
     */
    public function getContentStreamIdentifier(): ContentStreamIdentifier
    {
        return $this->contentStreamIdentifier;
    }

    /**
     * @return NodeAggregateIdentifier
     */
    public function getNodeAggregateIdentifier(): NodeAggregateIdentifier
    {
        return $this->nodeAggregateIdentifier;
    }

    /**
     * @return OriginDimensionSpacePoint
     */
    public function getSourceOrigin(): OriginDimensionSpacePoint
    {
        return $this->sourceOrigin;
    }

    /**
     * @return OriginDimensionSpacePoint
     */
    public function getPeerOrigin(): OriginDimensionSpacePoint
    {
        return $this->peerOrigin;
    }

    /**
     * @return DimensionSpacePointSet
     */
    public function getPeerCoverage(): DimensionSpacePointSet
    {
        return $this->peerCoverage;
    }

    /**
     * @param ContentStreamIdentifier $targetContentStreamIdentifier
     * @return NodePeerVariantWasCreated
     */
    public function createCopyForContentStream(ContentStreamIdentifier $targetContentStreamIdentifier): NodePeerVariantWasCreated
    {
        return new NodePeerVariantWasCreated(
            $targetContentStreamIdentifier,
            $this->nodeAggregateIdentifier,
            $this->sourceOrigin,
            $this->peerOrigin,
            $this->peerCoverage
        );
    }
}
