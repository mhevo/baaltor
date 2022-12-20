<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TranslateModel;
use App\Models\Translations;

class TranslateController extends Controller
{
    public static $languages = [
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
    
    public function translate(Request $request)
    {
        $input = $request->get('translateFrom');
        $toLanguage = $request->get('toLanguage');
        
        if (in_array($toLanguage, self::$languages) === false) {
            $toLanguage = 'enUs';
        }
        
        $tm = new TranslateModel();
        $tm->searchWords($input);
        $output = $tm->combineSearchResults($toLanguage);
        if (empty($output) === true) {
            $tm->searchWord($input);
            $output = $tm->combineSearchResults($toLanguage);
        }
        
        return view('translationresult', [
            'input' => $input,
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
