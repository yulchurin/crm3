<?php declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Support\Facades\Lang;
use NumberFormatter;

class SumToWords
{
    /**
     * Converts Sum in kopecks to words
     *
     * (e.g. 5000 rub 70 kop is 500070
     * due PHP has not Decimal Type,
     * and we don't want to have problems with floats)
     *
     * (int) 500070 => (string) "пять тысяч рублей 70 копеек"
     *
     * @param int $sum
     * @return string
     */
    public static function spell(int $sum): string
    {
        $rubles = MoneyTransformer::getRubles($sum);
        $kopeck = MoneyTransformer::getKopecks($sum);

        $formatter = new NumberFormatter('ru', NumberFormatter::SPELLOUT);
        $strRub = $formatter->format($rubles);

        $rub = Lang::choice('рубль|рубля|рублей', $rubles, [], 'ru');
        $kop = Lang::choice('копейка|копейки|копеек', $kopeck, [], 'ru');

        $kopeck = $kopeck > 9 ? $kopeck : "0$kopeck";

        return "$strRub $rub $kopeck $kop";
    }
}
