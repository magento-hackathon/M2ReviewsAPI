<?php

namespace MagentoHackathon\ReviewsApi\Model;

use MagentoHackathon\ReviewsApi\Api\ReviewsRepositoryInterface;
use Magento\Review\Model\Review as CoreReview;

class ReviewsRepository implements ReviewsRepositoryInterface
{
    public function __construct(
        \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory,
        \Magento\Review\Model\ReviewFactory $reviewFactory,
        \Magento\Review\Model\RatingFactory $ratingFactory,
        \Magento\Review\Model\ResourceModel\Rating\Option\CollectionFactory $optionCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Review\Model\ResourceModel\Rating\Collection $ratingCollectionFactory,
        \Magento\Framework\App\ResourceConnection $resource,
        \Magento\Catalog\Model\ResourceModel\Product $resourceModel,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->ratingCollectionFactory = $ratingCollectionFactory;
        $this->reviewFactory = $reviewFactory;
        $this->ratingFactory = $ratingFactory;
        $this->optionCollectionFactory = $optionCollectionFactory;
        $this->storeManager = $storeManager;
        $this->resource = $resource;
        $this->productFactory = $productFactory;
        $this->resourceModel = $resourceModel;

    }

    public function getByProductId($productId)
    {
        $collection = $this->collectionFactory->create()->addFieldToFilter('entity_pk_value', $productId)
            ->addFieldToFilter('entity_id', self::PRODUCT_ENTITY_ID);
        $collection->load();
        $collection->addRateVotes();

        $allItems = [];
        foreach($collection->getItems() as $item) {
            $itemArray = $item->getData();
            unset($itemArray['rating_votes']);

            /** @var \Magento\Review\Model\ResourceModel\Rating\Option\Vote\Collection $votes */
            $votes = $item->getRatingVotes();
            $vote = current($votes->getData());

            $itemArray['rating'] = $vote['value'];

            $allItems[] = $itemArray;
        }

        return $allItems;
    }

    public function post(\MagentoHackathon\ReviewsApi\Model\Review $reviewSkeleton)
    {
        if($this->_hasMadeReview($reviewSkeleton->getCustomerId(), $reviewSkeleton->getProductId())) {
            $ret['error'][] = ['message' => "Error: you have already made a review"];
            return $ret;
        }

        $review = $this->reviewFactory->create()->setData($reviewSkeleton->getData());
        $review->setEntityId($review->getEntityIdByCode(CoreReview::ENTITY_PRODUCT_CODE))
            ->setEntityPkValue($reviewSkeleton->getProductId())
            ->setStatusId(CoreReview::STATUS_APPROVED)
            ->setCustomerId($reviewSkeleton->getCustomerId())
            ->setStoreId($this->storeManager->getStore()->getId())
            ->setStores([$this->storeManager->getStore()->getId()])
            ->save();

        $collection = $this->optionCollectionFactory->create()
            ->addFieldToFilter('value', $review->getRating());

        /** @var \Magento\Review\Model\Rating\Option $option */
        foreach($collection as $option) {
            $this->ratingFactory->create()
                ->setRatingId($option->getRatingId())
                ->setReviewId($review->getId())
                ->setCustomerId($reviewSkeleton->getCustomerId())
                ->addOptionVote($option->getId(), $reviewSkeleton->getProductId());
        }

        $review->aggregate();

        return [['status' => 'success', 'message' => __("Thank you for posting your review")]];

    }

    protected function _hasMadeReview($customerId, $productId)
    {
        $collection = $this->collectionFactory->create();

        $collection->addFieldToFilter('customer_id', $customerId)
            ->addFieldToFilter('entity_pk_value', $productId);


        return ($collection->getSize() > 0);
    }


}