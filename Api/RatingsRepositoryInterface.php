<?php
namespace MagentoHackathon\ReviewsApi\Api;

use MagentoHackathon\ReviewsApi\Api\Data\RatingInterface;

interface RatingsRepositoryInterface
{
    /**
     * Get Ratings list by product
     * 
     * @param int $productId
     * @return \MagentoHackathon\ReviewsApi\Api\Data\RatingInterface[]
     */
    public function getByProduct($productId);

    /**
     * Get All Ratings
     * 
     * @return \MagentoHackathon\ReviewsApi\Api\Data\RatingInterface[]
     */
    public function getList();
    
//    public function post();
//    public function patch();
}