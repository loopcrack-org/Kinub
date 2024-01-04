<?php

namespace App\Models;

use Ausi\SlugGenerator\SlugGenerator;
use CodeIgniter\Model;

class ProductTagModel extends Model
{
    protected $table            = 'product_tags';
    protected $primaryKey       = 'ptId';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ptName', 'ptSlug', 'ptProductId'];

    public function createProductTags(string $productId, array $productTags)
    {
        $slugGenerator = new SlugGenerator();
        $tags          = array_map(static function ($productTag) use ($productId, $slugGenerator) {
            return [
                'ptName'      => $productTag,
                'ptSlug'      => $slugGenerator->generate($productTag),
                'ptProductId' => $productId,
            ];
        }, $productTags);

        $this->insertBatch($tags);
    }

    public function getProductTagsByProductId($productId)
    {
        $productTags = $this->where('ptProductId', $productId)->findAll();

        return implode(',', array_map(static fn ($tag) => $tag['ptName'], $productTags));
    }
}
