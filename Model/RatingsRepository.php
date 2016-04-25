<?php 

namespace MagentoHackathon\ReviewsApi\Model;

use Magento\Framework\DB\Adapter\AdapterInterface;
use MagentoHackathon\ReviewsApi\Api\RatingsRepositoryInterface;

class RatingsRepository implements RatingsRepositoryInterface
{

    protected $resource;


    public function __construct(
        \Magento\Framework\App\ResourceConnection $resource,
        \MagentoHackathon\ReviewsApi\Model\RatingFactory $ratingFactory
    )
    {
        $this->resource = $resource;
        $this->ratingFactory = $ratingFactory;
    }

    public function getByProduct($productId, $storeId = 1)
    {
        $results = $this->_fetchAggregatedResults($storeId, $productId);
        return $this->_parseResults($results);
    }


    public function getList($storeId = 1)
    {
        $results = $this->_fetchAggregatedResults($storeId);
        return $this->_parseResults($results);
    }


    protected function _parseResults($results)
    {
        if(count($results) == 0) return [];

        foreach($results as $value) {
            /** @var Rating $rating */
            $rating = $this->ratingFactory->create();

            $rating->setRating(ceil($value['vote_value_sum'] / $value['vote_count']))
                ->setCount($value['vote_count']);
            
            $ratings[] = $rating;
//            $ratings[] =
//            $ratings['items'][$value['entity_pk_value']] = [
//                'rating' => ceil($value['vote_value_sum'] / $value['vote_count']),
//                'count' => $value['vote_count']
//            ];

        }

        return $ratings;
    }

    protected function _fetchAggregatedResults($storeId = 1, $productId = null)
    {
        /** @var AdapterInterface $connection */
        $connection = $this->resource->getConnection('core_read');

        $query = 'SELECT * FROM rating_option_vote_aggregated WHERE store_id = :storeId';

        $queryBind['storeId'] = $storeId;
        if($productId) {
            $query .= ' AND entity_pk_value = :productId';
            $queryBind['productId'] = $productId;
        }
        $return = $connection->fetchAll($query, $queryBind);

        return $return;

    }

}