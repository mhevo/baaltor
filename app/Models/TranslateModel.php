<?php

namespace App\Models;

use App\Http\Controllers\TranslateController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Translations;

/**
 * App\Models\TranslateModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|TranslateModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TranslateModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TranslateModel query()
 * @mixin \Eloquent
 */
class TranslateModel extends Model
{
    use HasFactory;

    private array $searchResults = [];
    private int $safetyCounter = 0;
    private string $searchCategory = '';

    public function searchWords(string $input, string $overhead = '')
    {
        $in = trim($input);
        if (empty($in) === true) {
            return;
        }
        $this->safetyCounter++;
        if ($this->safetyCounter > 10) {
            return;
        }

        $ts = Translations::where('value', '=', $in)->get();

        if ($ts->isNotEmpty() === true) {
            foreach ($ts as $t) {
                $w = $t->word()->get();
                if ($this->isInSearchCategory($w[0]->filename) === false) {
                    continue;
                }
                $this->searchResults[$t->lang][] = $t;
            }
            return $this->searchWords($overhead);
        }

        $words = explode(' ', $in);
        $overhead = array_pop($words) . ' ' . $overhead;

        if (empty($overhead) === true) {
            return;
        }

        $nextInput = implode(' ', $words);
        return $this->searchWords($nextInput, $overhead);
    }

    public function searchWord(string $input): bool
    {
        if (empty($input) === true) {
            return false;
        }

        if (strlen($input < 3)) {
            return false;
        }

        $ts = Translations::where('value', 'LIKE', '%' . $input . '%')->get();


        if ($ts->isNotEmpty() === true) {
            $this->searchResults[] = $ts;
            return true;
        }

        return false;
    }

    /**
     *
     * @param string $toLanguage
     * @return array
     */
    public function combineSearchResults(string $toLanguage): array
    {
        $output = [];
        foreach ($this->getSearchResults() as $lang => $searchResult) {
            foreach ($searchResult as $key => $item) {
                /** @var Translations $item */
                /** @var Words $word */
                $word = $item->word();
                if ($toLanguage === 'enUS') {
                    $translatedWord = $word->get()[0]->enUs;
                } else {
                    $translations = Translations::where(
                        [
                            'id_trans_word' => $word->get()[0]->id,
                            'lang' => $toLanguage
                        ],
                    )->get();
                    $translatedWord = $translations[0]->value;
                }
                if (
                    isset($output[$lang]) === true &&
                    in_array($translatedWord, $output[$lang]) === true
                ) {
                    continue;
                }
                $output[$lang][] = $translatedWord;
            }
        }
        return $output;
    }

    public function getSearchResults()
    {
        return $this->searchResults;
    }

    public function importTranslationData($jsonData, $file)
    {
        foreach ($jsonData as $data) {
            foreach ($data as $k => $v) {
                $query = 'SELECT * FROM trans_words WHERE d2_key = ?';
                $dbWord = DB::select($query, [$data->Key]);

                if (empty($dbWord) === true) {
                    $this->insertWord($data, $file);
                }
            }
        }
    }

    private function insertWord($word, $file)
    {
        $skipKeys = [
            'id',
            'Key'
        ];

        $words = new Words();
        $words->d2_id = $word->id;
        $words->d2_key = $word->Key;
        $words->filename = $file;
        $words->enUs = $word->enUS;
        $words->save();

        foreach ($word as $key => $value) {
            if (in_array($key, $skipKeys) === true) {
                continue;
            }
            /**
             * [ms] = male single
             * [fs] = female single
             * [ns] = neutral single
             * [pl] = plural
             * [mp] = male plural
             * [fp] = female plural
             */

//            $split = preg_split('/\[[a-z]{2}\]/mi', $value);
            $matches = [];
            preg_match_all('/\[([a-z]{2})\]([^\[]+)/mi', $value, $matches);

            if (empty($matches[0]) === true) {
                $translations = new Translations();
                $translations->id_trans_word = $words->id;
                $translations->lang = $key;
                $translations->flexion = '';
                $translations->value = $value;
                $translations->save();
                continue;
            }

            foreach ($matches[1] as $matchKey => $flexion) {
                $value = $matches[2][$matchKey];
                $translations = new Translations();
                $translations->id_trans_word = $words->id;
                $translations->lang = $key;
                $translations->flexion = $flexion;
                $translations->value = $value;
                $translations->save();
            }
        }
    }

    /**
     * @param string $category
     * @return bool
     */
    private function isInSearchCategory(string $category): bool
    {
        $validCategoires = TranslateController::$searchCategoriesFilter[$this->searchCategory];
        if (in_array($category, $validCategoires) === true) {
            return true;
        }
        return false;
    }

    /**
     * @param string|null $category
     * @return void
     */
    public function setSearchCategory(?string $category): void
    {

        if (
            isset($category) === false ||
            in_array($category, TranslateController::$searchCategories) === false
        ) {
            $this->searchCategory = 'all';
            return;
        }
        $this->searchCategory = $category;
    }
}
