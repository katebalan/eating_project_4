<?php
declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Products;

/**
 * Class ProductsRepository
 * @package App\Repository
 */
class ProductsRepository extends EntityRepository
{
    /**
     * @return Products[]
     */
    public function findAllOrderedByDescActive()
    {
        return $this->createQueryBuilder('products')
            ->orderBy('products.createdAt', 'DESC')

            ->getQuery()
            ->execute();
    }
}
