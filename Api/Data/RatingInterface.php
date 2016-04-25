<?php

namespace MagentoHackathon\ReviewsApi\Api\Data;

interface RatingInterface
{
    /**
     * @return int
     */
    public function getRating();

    /**
     * @param $rating
     * @return mixed
     */
    public function setRating($rating);

    /**
     * @return int
     */
    public function getCount();

    /**
     * @param $count
     * @return mixed
     */
    public function setCount($count);
    
}