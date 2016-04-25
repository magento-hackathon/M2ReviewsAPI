<?php
namespace MagentoHackathon\ReviewsApi\Model;

use MagentoHackathon\ReviewsApi\Api\Data\ReviewInterface;

class Review extends \Magento\Framework\Model\AbstractModel
    implements ReviewInterface
{
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title)
    {
        $this->setData('title', $title);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->getData('detail');
    }

    /**
     * @param $detail
     * @return mixed
     */
    public function setDetail($detail)
    {
        $this->setData('detail', $detail);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->getData('nickname');
    }

    /**
     * @param $nick
     * @return mixed
     */
    public function setNickname($nick)
    {
        $this->setData('nickname', $nick);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function setCustomerId($id)
    {
        $this->setData('customer_id', $id);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->getData('rating');
    }

    /**
     * @param $rating
     * @return mixed
     */
    public function setRating($rating)
    {
        $this->setData('rating', $rating);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->getData('product_id');
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function setProductId($productId)
    {
        $this->setData('product_id', $productId);
        return $this;
    }


}