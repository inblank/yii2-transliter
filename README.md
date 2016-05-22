# Yii2 transliterator

[![Build Status](https://img.shields.io/travis/inblank/yii2-transliter/master.svg?style=flat-square)](https://travis-ci.org/inblank/yii2-transliter)
[![Packagist Version](https://img.shields.io/packagist/v/inblank/yii2-transliter.svg?style=flat-square)](https://packagist.org/packages/inblank/yii2-transliter)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/inblank/yii2-transliter/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/inblank/yii2-transliter/?branch=master)
[![Code Quality](https://img.shields.io/scrutinizer/g/inblank/yii2-transliter/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/inblank/yii2-transliter/?branch=master)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://raw.githubusercontent.com/inblank/yii2-transliter/master/LICENSE)

> **[Русская версия](https://github.com/inblank/yii2-transliter/blob/master/README_RU.md)** доступна [здесь](https://github.com/inblank/yii2-transliter/blob/master/README_RU.md).

This transliteration component is used mainly for the transliteration of 
strings in the Russian language by the rules which are well understood 
[Yandex](http://www.yandex.ru), and used to improve SEO.

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Navigate to the project folder and run the console command:

```bash
$ composer require inblank/yii2-transliter
```

or add:

```json
"inblank/yii2-transliter": "~0.1"
```

to the `require` section of your `composer.json` file.

## Configuring

In the application configuration file in section `components` add the lines:
```php
'transliter' => [
    'class' => 'inblank\transliter\Transliter',
],

```

As with all components in Yii2 you can set your parameters for the class.

### Usage

To transliterate of the string simple run:

```php
$result = Yii::$app->transliter->translate($str);
```
