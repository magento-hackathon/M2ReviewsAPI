<?php
namespace MagentoHackathon\ReviewsApi\Api;

use MagentoHackathon\ReviewsApi\Api\Data\RatingInterface;

interface RatingsRepositoryInterface
{
    /**
     * Get Ratings list by product
     * 
     * @param $productId
     * @return RatingInterface[]
     */
    public function getByProduct($productId);

    /**
     * Get All Ratings
     * 
     * @return RatingInterface[]
     */
    public function getList();
    
//    public function post();
//    public function patch();
}