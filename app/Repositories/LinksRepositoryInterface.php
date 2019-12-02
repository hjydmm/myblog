<?php


namespace App\Repositories;


interface LinksRepositoryInterface
{
    public function getLinks($where, $order_by, $limit = 5);
}