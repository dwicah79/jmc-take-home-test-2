<?php
namespace App\Repository\Interfaces;

interface IncomingGoodsRepositoryInterfaces
{
    public function all($filters, $search = null);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getOperator();
    public function getCategory();
    public function getSubCategory($categoryId);
}
