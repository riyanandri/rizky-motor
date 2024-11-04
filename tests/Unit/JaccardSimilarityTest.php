<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Artisan;

class JaccardSimilarityTest extends TestCase
{
    /**
     * Helper function to calculate Jaccard Similarity.
     */
    private function jaccardSimilarity($str1, $str2)
    {
        // Normalisasi dan pembentukan set karakter
        $set1 = collect(str_split($str1))->unique()->sort()->values()->all();
        $set2 = collect(str_split($str2))->unique()->sort()->values()->all();

        // Hitung intersection dan union
        $intersection = array_intersect($set1, $set2);
        $union = array_unique(array_merge($set1, $set2));

        // Cek jika union kosong (kasus string kosong)
        if (count($union) === 0) {
            return 1.0;
        }

        // Hitung Jaccard similarity
        return count($intersection) / count($union);
    }

    /**
     * Test case for identical strings.
     */
    public function testIdenticalStrings()
    {
        $start = microtime(true);
        $similarity = $this->jaccardSimilarity('oli yamalube', 'oli yamalube');
        $end = microtime(true);

        $executionTime = ($end - $start) * 1000; // convert to milliseconds

        $this->assertEquals(1.0, $similarity);
        echo "Tes string identik dieksekusi dalam " . $executionTime . " ms.\n";
    }

    /**
     * Test case for completely different strings.
     */
    public function testDifferentStrings()
    {
        $start = microtime(true);
        $similarity = $this->jaccardSimilarity('nitro', 'oli yamalube');
        $end = microtime(true);

        $executionTime = ($end - $start) * 1000; // convert to milliseconds

        $this->assertEquals(0.0, $similarity);
        echo "Tes string berbeda sepenuhnya dieksekusi dalam " . $executionTime . " ms.\n";
    }

    /**
     * Test case for partially similar strings.
     */
    public function testPartiallySimilarStrings()
    {
        $start = microtime(true);
        $similarity = $this->jaccardSimilarity('oli motul', 'motul oli');
        $end = microtime(true);

        $executionTime = ($end - $start) * 1000; // convert to milliseconds

        $this->assertEquals(0.6, $similarity);
        echo "Tes string dengan kemiripan sebagian dieksekusi dalam " . $executionTime . " ms.\n";
    }

    /**
     * Test case for empty strings.
     */
    public function testSpecialCharacterStrings()
    {
        $start = microtime(true);
        $similarity = $this->jaccardSimilarity('yamaha, oli', 'oli yamalube');
        $end = microtime(true);

        $executionTime = ($end - $start) * 1000; // convert to milliseconds

        $this->assertEquals(0.3, $similarity);
        echo "Tes string dengan spesial karakter dieksekusi dalam " . $executionTime . " ms.\n";
    }

    /**
     * Test case for one empty string.
     */
    public function testEmptyStrings()
    {
        $start = microtime(true);
        $similarity = $this->jaccardSimilarity('', 'oli yamalube');
        $end = microtime(true);

        $executionTime = ($end - $start) * 1000; // convert to milliseconds

        $this->assertEquals(0.0, $similarity);
        echo "Tes string kosong dieksekusi dalam " . $executionTime . " ms.\n";
    }
}
