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
    public function get($productId);
    
    /**
     * Get all reviews
     * 
     * @param string $productId
     * @return array
     */
    public function getList();


    /**
     * Save Review
     * 
     * @param Review $review
     * @return mixed[]
     */
    public function save(Review $review);

}