<?php
namespace MagentoHackathon\ReviewsApi\Api\Data;

interface ReviewInterface
{

    public function getTitle();
    public function setTitle($title);

    public function getDetail();
    public function setDetail($detail);

    public function getNickname();
    public function setNickname($nick);

    public function getCustomerId();
    public function setCustomerId($id);

    public function getRating();
    public function setRating($rating);

    public function getProductId();
    public function setProductId($productId);


}