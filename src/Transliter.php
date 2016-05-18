<?php
namespace inblank\transliter;

use yii\base\Component;

/**
 * Transliteration
 *
 * @link https://github.com/inblank/yii2-transliter
 * @copyright Copyright (c) 2016 Pavel Aleksandrov <inblank@yandex.ru>
 * @license http://opensource.org/licenses/MIT
 */
class Transliter extends Component
{
    /**
     * Transliteration table for Russian characters
     * CAUTION: for this table you always must run callback Transliter::defaultAfter() because
     * russian `х` replaced on english `x` for future use in special rules which applies in `defaultAfter`
     * After applying `defaultAfter` russian `х` will be replaced on `h` or `kh` if follows after c,s,e,h
     * @var array
     */
    public $table = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z',
        'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'x', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch',
        'ы' => 'y', 'э' => 'eh', 'ю' => 'yu', 'я' => 'ya', 'ь' => '', 'ъ' => '',

        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh', 'З' => 'Z',
        'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O', 'П' => 'P', 'Р' => 'R',
        'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'X', 'Ц' => 'C', 'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Shch',
        'Ы' => 'Y', 'Э' => 'Eh', 'Ю' => 'Yu', 'Я' => 'Ya', 'Ь' => '', 'Ъ' => '',
    ];
    /**
     * @var bool a sign of permissibility of dots in the transliterate result
     */
    public $useDot = false;
    /**
     * @var string space replace character
     */
    public $spacer = "-";
    /**
     * @var callable function|method calling with result string after transliteration
     */
    public $after = ["self", "defaultAfter"];
    /**
     * @var bool replace character for non alphanumeric characters. If false - special chars cuts
     */
    public $replaceSpecial = false;

    /**
     * @var bool convert result to lowercase
     */
    public $toLower = true;

    /**
     * Default after table translate method for Russian characters
     * @param string $str transliterated string
     * @return mixed
     */
    public static function defaultAfter($str)
    {
        // replace special cases for h for Russian language
        return preg_replace('/[x]/uim', 'h', preg_replace('/([cseh]){1}x/uim', '${1}kh', $str));
    }

    /**
     * Transliterate method
     * @param string $str input string
     * @param null|string $spacer space replacer. If null uses Transliter::$spacer
     * @param null|bool $toLower convert result to lowercase. If null uses Transliter::$toLower
     * @return string
     */
    public function translate($str, $spacer = null, $toLower = null)
    {
        if ($spacer === null) {
            $spacer = $this->spacer;
        }
        if ($toLower === null) {
            $toLower = $this->toLower;
        }
        $str = strtr($str, $this->table);
        if (is_callable($this->after)) {
            $str = call_user_func($this->after, $str);
        }
        // replace all non alpha-numeric characters
        $str = preg_replace('~[^' . ($this->useDot ? '\.' : '') . '\s\w\d_]~uism', empty($this->replaceSpecial) ? '' : $this->replaceSpecial, $str);
        // replace spaces
        $str = preg_replace('/\s/u', $spacer, $str);
        if ($toLower) {
            $str = strtolower($str);
        }
        return $str;
    }
}
