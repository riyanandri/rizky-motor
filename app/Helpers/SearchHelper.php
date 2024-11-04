<?php
namespace App\Helpers;

class SearchHelper
{
    public static function normalize($text)
    {
        return strtolower(trim(preg_replace('/\s+/', ' ', $text)));
    }

    public static function jaccardSimilarity($str1, $str2)
    {
        $str1 = self::normalize($str1);
        $str2 = self::normalize($str2);

        $set1 = array_unique(explode(' ', $str1));
        $set2 = array_unique(explode(' ', $str2));

        $intersection = array_intersect($set1, $set2);
        $union = array_unique(array_merge($set1, $set2));

        if (count($union) == 0) {
            return 0;
        }

        return count($intersection) / count($union);
    }

    // public static function tf($term, $document)
    // {
    //     $document = self::normalize($document);
    //     $term = self::normalize($term);

    //     $words = explode(' ', $document);
    //     $termCount = array_count_values($words);
    //     $wordCount = count($words);

    //     if ($wordCount == 0) {
    //         return 0; // Menghindari pembagian oleh nol
    //     }
    //     return ($termCount[$term] ?? 0) / $wordCount;
    // }

    // public static function idf($term, $documents)
    // {
    //     $term = self::normalize($term);
    //     $numDocumentsContainingTerm = 0;
    //     foreach ($documents as $document) {
    //         $document = self::normalize($document);
    //         if (stripos($document, $term) !== false) {
    //             $numDocumentsContainingTerm++;
    //         }
    //     }
    //     return log(count($documents) / (1 + $numDocumentsContainingTerm));
    // }

    // public static function tfidf($term, $document, $documents)
    // {
    //     $tf = self::tf($term, $document);
    //     $idf = self::idf($term, $documents);
    //     return $tf * $idf;
    // }

    // public static function cosineSimilarity($vec1, $vec2)
    // {
    //     $dotProduct = 0.0;
    //     $normA = 0.0;
    //     $normB = 0.0;

    //     foreach ($vec1 as $key => $value) {
    //         $dotProduct += $value * ($vec2[$key] ?? 0);
    //         $normA += $value ** 2;
    //     }

    //     foreach ($vec2 as $value) {
    //         $normB += $value ** 2;
    //     }

    //     if (sqrt($normA) == 0 || sqrt($normB) == 0) {
    //         return 0; // Menghindari pembagian oleh nol
    //     }

    //     return $dotProduct / (sqrt($normA) * sqrt($normB));
    // }

    // public static function levenshteinSimilarity($str1, $str2)
    // {
    //     $str1 = self::normalize($str1);
    //     $str2 = self::normalize($str2);

    //     $levDistance = levenshtein($str1, $str2);
    //     $maxLen = max(strlen($str1), strlen($str2));
    //     if ($maxLen == 0) {
    //         return 1.0;
    //     }
    //     return 1 - ($levDistance / $maxLen);
    // }

}