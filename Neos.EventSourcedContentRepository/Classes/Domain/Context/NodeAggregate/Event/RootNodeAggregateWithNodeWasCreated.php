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

use Neos\ContentRepository\DimensionSpace\DimensionSpace\DimensionSpacePointSet;
use Neos\ContentRepository\Domain\ContentStream\ContentStreamIdentifier;
use Neos\ContentRepository\Domain\NodeAggregate\NodeAggregateIdentifier;
use Neos\ContentRepository\Domain\NodeType\NodeTypeName;
use Neos\EventSourcedContentRepository\Domain\Context\Node\CopyableAcrossContentStreamsInterface;
use Neos\EventSourcedContentRepository\Domain\Context\NodeAggregate\NodeAggregateClassification;
use Neos\EventSourcedContentRepository\Domain\ValueObject\UserIdentifier;
use Neos\EventSourcing\Event\DomainEventInterface;
use Neos\Flow\Annotations as Flow;

/**
 * A root node aggregate and its initial node were created
 *
 * @Flow\Proxy(false)
 */
final class RootNodeAggregateWithNodeWasCreated implements DomainEventInterface, CopyableAcrossContentStreamsInterface
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
     * @var NodeTypeName
     */
    protected $nodeTypeName;

    /**
     * Root nodes are by definition visible in *all* dimension space points; so we need to include the full list here.
     *
     * @var DimensionSpacePointSet
     */
    private $visibleInDimensionSpacePoints;

    /**
     * @var NodeAggregateClassification
     */
    private $nodeAggregateClassification;

    /**
     * @var UserIdentifier
     */
    private $initiatingUserIdentifier;

    public function __construct(
        ContentStreamIdentifier $contentStreamIdentifier,
        NodeAggregateIdentifier $nodeAggregateIdentifier,
        NodeTypeName $nodeTypeName,
        DimensionSpacePointSet $visibleInDimensionSpacePoints,
        NodeAggregateClassification $nodeAggregateClassification,
        UserIdentifier $initiatingUserIdentifier
    ) {
        $this->contentStreamIdentifier = $contentStreamIdentifier;
        $this->nodeAggregateIdentifier = $nodeAggregateIdentifier;
        $this->nodeTypeName = $nodeTypeName;
        $this->visibleInDimensionSpacePoints = $visibleInDimensionSpacePoints;
        $this->nodeAggregateClassification = $nodeAggregateClassification;
        $this->initiatingUserIdentifier = $initiatingUserIdentifier;
    }

    public function getContentStreamIdentifier(): ContentStreamIdentifier
    {
        return $this->contentStreamIdentifier;
    }

    public function getNodeAggregateIdentifier(): NodeAggregateIdentifier
    {
        return $this->nodeAggregateIdentifier;
    }

    public function getNodeTypeName(): NodeTypeName
    {
        return $this->nodeTypeName;
    }

    public function getVisibleInDimensionSpacePoints(): DimensionSpacePointSet
    {
        return $this->visibleInDimensionSpacePoints;
    }

    public function getNodeAggregateClassification(): NodeAggregateClassification
    {
        return $this->nodeAggregateClassification;
    }

    public function getInitiatingUserIdentifier(): UserIdentifier
    {
        return $this->initiatingUserIdentifier;
    }

    public function createCopyForContentStream(ContentStreamIdentifier $targetContentStream): RootNodeAggregateWithNodeWasCreated
    {
        return new RootNodeAggregateWithNodeWasCreated(
            $targetContentStream,
            $this->nodeAggregateIdentifier,
            $this->nodeTypeName,
            $this->visibleInDimensionSpacePoints,
            $this->nodeAggregateClassification,
            $this->initiatingUserIdentifier
        );
    }
}