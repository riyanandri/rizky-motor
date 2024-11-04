<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'merk_id',
        'product_code',
        'product_name',
        'unit',
        'qty',
        'price',
        'condition',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function specification()
    {
        return $this->hasMany(Specification::class);
    }

    public static function jaccardSimilarityNgram($query, $target, $n = 2)
    {
        $query = self::normalizeText($query);
        $target = self::normalizeText($target);

        $queryNgrams = self::getNgrams($query, $n);
        $targetNgrams = self::getNgrams($target, $n);

        $intersection = array_intersect($queryNgrams, $targetNgrams);
        $union = array_unique(array_merge($queryNgrams, $targetNgrams));

        $similarity = count($intersection) / count($union);

        return $similarity;
    }

    public static function normalizeText($text)
    {
        $text = preg_replace('/\s+/', ' ', $text);

        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);

        $text = strtolower($text);

        $text = trim($text);

        return $text;
    }

    private static function getNgrams($string, $n)
    {
        $ngrams = [];
        $length = strlen($string);

        if ($length < $n) {
            return [$string];
        }

        for ($i = 0; $i <= $length - $n; $i++) {
            $ngrams[] = substr($string, $i, $n);
        }

        return $ngrams;
    }
}
