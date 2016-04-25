<?php
namespace MagentoHackathon\ReviewsApi\Model;

use MagentoHackathon\ReviewsApi\Api\Data\RatingInterface;

class Rating extends \Magento\Framework\Model\AbstractModel
    implements RatingInterface
{
    public function getCount()
    {
        return $this->_getData('count');
    }
    public function getRating()
    {
        return $this->_getData('rating');
    }
    public function setCount($count)
    {
        $this->setData('count', $count);
        return $this;
    }
    public function setRating($rating)
    {
        $this->setData('rating', $rating);
        return $this;
    }
}