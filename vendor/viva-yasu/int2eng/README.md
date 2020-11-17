# Int2Eng
Int2Eng is a converter of the integer to English.

# Install
```
$ php composer.phar require viva-yasu/int2eng:dev-master
```
or
```
{
  "require": {
      "viva-yasu/int2eng": "dev-master"
  }
}
```
write the above in composer.json

# Usage
```
<?php

use VivaYasu\Int2Eng\Int2Eng;

require_once("vendor/autoload.php");

$int2eng = new Int2Eng(777);
echo $int2eng->get_eng(); // seven hundred and seventy seven
```
the param of this constructor is `Integer` to want to convert to English. 