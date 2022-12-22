<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TranslateModel;
use App\Models\Translations;

class TranslateController extends Controller
{
    public static array $languages = [
        'enUS',
        'zhTW',
        'deDE',
        'esES',
        'frFR',
        'itIT',
        'koKR',
        'plPL',
        'esMX',
        'jaJP',
        'ptBR',
        'ruRU',
        'zhCN',
    ];

    public static array $searchCategories = [
        'all',
        'itemname',
        'magicitemname',
        'area',
        'skill'
    ];

    public static array $searchCategoriesFilter = [
        'all' => [
            'item-gems.json',
            'item-modifiers.json',
            'item-nameaffixes.json',
            'item-names.json',
            'item-runes.json',
            'levels.json',
            'monsters.json',
            'shrines.json',
            'skills.json'
        ],
        'itemname' => [
            'item-gems.json',
            'item-names.json',
            'item-runes.json'
        ],
        'magicitemname' => [
            'item-nameaffixes.json',
            'item-names.json',
        ],
        'area' => [
            'levels.json',
        ],
        'skill' => [
            'skills.json'
        ]
    ];

    public function translate(Request $request)
    {
        $input = $request->get('translateFrom');
        $toLanguage = $request->get('toLanguage');
        $searchCategory = $request->get('search-category');

        if (empty(trim($input)) === true) {
            return redirect('/');
        }

        if (in_array($toLanguage, self::$languages) === false) {
            $toLanguage = 'enUs';
        }

        $tm = new TranslateModel();
        $tm->setSearchCategory($searchCategory);
        $tm->searchWords($input);
        $output = $tm->combineSearchResults($toLanguage, true);
        if (empty($output) === true) {
            $tm->searchWord($input);
            $output = $tm->combineSearchResults($toLanguage, false);
        }
dump($output);
        return view('translationresult', [
            'input' => $input,
            'toLanguage' => $toLanguage,
            'searchCategory' => $searchCategory,
            'resultset' => $output,
            'languages' => self::$languages
        ]);
    }

    public function importTranslations()
    {
        /**
         * /data/data/local/lng/strings/
         */
        $importCount = 0;
        $files = scandir(base_path() . '/data/todo');
        foreach ($files as $file) {
            if ($importCount > 0) {
                return;
            }
            if ($file === '.' || $file === '..') {
                continue;
            }
            if (is_dir(base_path() . '/data/todo/' . $file) === true) {
                continue;
            }
            $ext = pathinfo($file)['extension'];
            if ($ext !== 'json') {
                continue;
            }
            $jsonContent = json_decode(file_get_contents(base_path() . '/data/todo/' . $file));

            if ($jsonContent === false) {
                continue;
            }

            $tm = new TranslateModel();
            $tm->importTranslationData($jsonContent, $file);

            rename(base_path() . '/data/todo/' . $file, base_path() . '/data/done/' . $file);
            $importCount++;
        }
    }
}
