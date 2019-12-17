<?php


namespace frontend\components;


class FrequentWords
{

    public $exclude = [
        "the",
        "be",
        "to",
        "of",
        "and",
        "a",
        "in",
        "that",
        "have",
        'i',
        'it',
        'for',
        'not',
        'on',
        'with',
        "he",
        'as',
        'you',
        'do',
        'at',
        'this',
        'but',
        'his',
        'by',
        'from',
        "they",
        "we",
        "say",
        'her',
        "she",
        'or',
        "an",
        "will",
        "my",
        "one",
        "all",
        "would",
        "there",
        "their",
        "what",
        "so",
        "up",
        "out",
        "if",
        "about",
        "who",
        "get",
        "which",
        "go",
        "me",
    ];
    public $splitPattern = "/[\s,.?]+/";
    public $verifyWordPattern = "/^[a-zA-Z]+$/";

    private $words;

    /**
     * @param array $feed
     * @return $this
     * collecting words list from array
     */
    public function collectWords(array $collection)
    {
        $split = $this->splitString($this->toIndexed($collection));
        $this->words = $this->verifyWord($this->toIndexed($split));
        return $this;
    }

    /**
     * @return $this
     * excluding specific words from words list
     */
    public function excludeWords()
    {
        $this->words = array_diff($this->words, $this->exclude);
        return $this;
    }

    /**
     * @return mixed
     * get words list
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * @param int $offset begin from
     * @param int $item show how much you want
     * @return array
     * get most frequent words from words list
     */
    public function getMostFrequentWords($offset = 0, $item = 10)
    {
        $values = array_count_values($this->words);
        arsort($values);
        return array_slice($values, $offset, $item);
    }

    /**
     * @param $words
     * @param string $pattern
     * @return array
     * Spilt string a given pattern
     */
    private function splitString(array $words): array
    {
        $soz = [];
        foreach ($words as $word) {
            $soz[] = preg_split($this->splitPattern, $word);
        }
        return $soz;
    }

    /**
     * @param array $words
     * @return array
     * verifying word on given string with specific pattern
     */
    private function verifyWord(array $words): array
    {
        $soz = [];
        foreach ($words as $word)
            if (preg_match($this->verifyWordPattern, $word)) {
                $soz[] = strtolower($word);
            }
        return $soz;
    }


    /**
     * @param $array
     * @return array
     * Converting multidimensional array to indexed array
     */
    private function toIndexed(array $array): array
    {
        $indexed = [];
        foreach ($array as $element) {
            if (is_array($element)) {
                $indexed = array_merge($indexed, $this->toIndexed($element));
            } else {
                $indexed = array_merge($indexed, [$element]);
            }
        }
        return $indexed;
    }


}