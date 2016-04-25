<?php
namespace MagentoHackathon\ReviewsApi\Api;


use MagentoHackathon\ReviewsApi\Model\Review;

interface ReviewsRepositoryInterface
{
    /**
     * Get Reviews By productId
     * 
     * @param $productId
     * @return array
     */
    public function getByProductId($productId);
    
    /**
     * Save Review
     * 
     * @param Review $review
     * @return mixed[]
     */
    public function post(Review $review);

}