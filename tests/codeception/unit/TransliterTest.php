<?php

namespace inblank\transliter\tests;

use Codeception\Specify;
use inblank\transliter\Transliter;
use yii;
use yii\codeception\TestCase;

class TransliterTest extends TestCase
{
    use Specify;

    /**
     * General test
     */
    public function testGeneral()
    {
        expect("transliter component must exists", Yii::$app->transliter)->isInstanceOf(Transliter::className());

        $alphabet = "абвгдеёжзийклмнопрстуфхцчшщыэюяьъАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЫЭЮЯЬЪ";
        $alphabetResult = "abvgdeyozhzijklmnoprstufxcchshshchyehyuyaABVGDEYoZhZIJKLMNOPRSTUFXCChShShchYEhYuYa";

        $oldAfter = Yii::$app->transliter->after;
        $oldToLower = Yii::$app->transliter->toLower;
        // turn off `after` callback for test direct translate
        Yii::$app->transliter->after = null;
        Yii::$app->transliter->toLower = false;
        expect("translate full alphabet", Yii::$app->transliter->translate($alphabet))->equals($alphabetResult);
        Yii::$app->transliter->after = $oldAfter;

        $this->specify('transliterate list of strings', function () {
            $strings = [
                'Alternativa' => 'Альтернатива',
                'Skotch' => 'Скотч',
                'Yashchik' => 'Ящик',
                'Shishka' => 'Шишка',
                'Shchitok' => 'Щиток',
                'Ochen-dlinnaya-stroka' => 'Очень длинная строка',
                'Shkhuna' => 'Шхуна',
                'Cekh' => 'Цех',
                'Voskhod' => 'Восход',
                'Ckhinval' => 'Цхинвал'
            ];
            foreach ($strings as $correctResult => $str) {
                $result = Yii::$app->transliter->translate($str);
                expect("transliterate string `{$str}`", $result)->equals($correctResult);
            }
        });

        Yii::$app->transliter->toLower = $oldToLower;


        $this->specify('transliterate with user `spacer`', function () {
            $str = 'Опять длинная Строка';
            $correctResult = "opyat+dlinnaya+stroka";
            $result = Yii::$app->transliter->translate($str, '+');
            expect("transliterate string `{$str}`", $result)->equals($correctResult);
        });

        $this->specify('transliterate with user `toLower`', function () {
            $str = 'ПрОсто ШиКАРНАЯ Строка ОТ ПОЛьзователЯ с ВЫвеРтОм';
            $correctResult = "prosto-shikarnaya-stroka-ot-polzovatelya-s-vyvertom";
            $result = Yii::$app->transliter->translate($str, null, true);
            expect("transliterate string `{$str}`", $result)->equals($correctResult);
        });

        $this->specify('transliterate with special chars', function () {
            $str = 'А~!@#$%^&*()_+`"№;:?-=[]{}\|<>.,\'/Я';
            // with cutting
            $correctResult = "a_ya";
            $result = Yii::$app->transliter->translate($str);
            expect("transliterate string `{$str}`", $result)->equals($correctResult);
            // without cutting
            $correctResult = "a_________________________________ya";
            Yii::$app->transliter->replaceSpecial = '_';
            $result = Yii::$app->transliter->translate($str);
            expect("transliterate string `{$str}`", $result)->equals($correctResult);
        });

        $this->specify('transliterate string with dots enables', function () {
            Yii::$app->transliter->useDot = true;
            $str = 'нашастрана.рф';
            $correctResult = "nashastrana.rf";
            $result = Yii::$app->transliter->translate($str);
            expect("transliterate string `{$str}`", $result)->equals($correctResult);
        });
    }

    protected function tearDown()
    {
        parent::tearDown();
    }
}
