# Yii2 transliterator

[![Build Status](https://img.shields.io/travis/inblank/yii2-transliter/master.svg?style=flat-square)](https://travis-ci.org/inblank/yii2-transliter)
[![Packagist Version](https://img.shields.io/packagist/v/inblank/yii2-transliter.svg?style=flat-square)](https://packagist.org/packages/inblank/yii2-transliter)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/inblank/yii2-transliter/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/inblank/yii2-transliter/?branch=master)
[![Code Quality](https://img.shields.io/scrutinizer/g/inblank/yii2-transliter/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/inblank/yii2-transliter/?branch=master)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/inblank/yii2-transliter/master/LICENSE)

> The **[English version](https://github.com/inblank/yii2-transliter/blob/master/README.md)** of this document available [here](https://github.com/inblank/yii2-transliter/blob/master/README.md).

Компонент для траслитерации строк с русского по правилам, которые хорошо понимает
[Яндекс](http://www.yandex.ru).
Есть возможность задание собственной таблицы перевода и финальной обработки результата.

По умолчанию делает дополнительную обработку русской `х` в результате по следующим правилам:
`kh` после букв `c`,`s`,`e`,`h`; в остальных случаях - `h`

## Установка

Рекомендуется устанавливать компонент через [composer](http://getcomposer.org/download/).

Перейдите в папку проекта и выполните в консоли команду:

```bash
$ composer require inblank/yii2-translite
```

или добавьте:

```json
"inblank/yii2-transliter": "~0.1"
```

в раздел `require` конфигурационного файла `composer.json`.

### Конфигурация:

В файле конфигурации приложения в разделе `components` добавьте строки:
```php
'transliter' => [
    'class' => 'inblank\transliter\Transliter',
],

```

Как и со всеми компонентами Yii2 можно задать свои параметры для класса.

### Использование

Для транслитерации строки вызовите в коде скрипта:
```php
$result = Yii::$app->transliter->translate($str);
```
