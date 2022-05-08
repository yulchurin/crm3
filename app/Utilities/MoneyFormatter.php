<?php declare(strict_types=1);

namespace App\Utilities;

/**
 * Transforms money from integer into separated
 */
final class MoneyFormatter
{
    /**
     * Returns split value ("rub.kop")
     *
     * e.g. (int) 500 => (string) 5.00
     *
     * @param int $value
     * @return string
     */
    public static function split(int $value): string
    {
        return substr((string) $value, 0, -2) .'.'. substr((string) $value, -2);
    }

    /**
     * Returns rubles value in int
     *
     * e.g. (int) 500 => (int) 5
     *
     * @param int $value
     * @return int
     */
    public static function getRubles(int $value): int
    {
        return (int) substr((string) $value, 0, -2);
    }

    /**
     * Returns kopecks value in int
     *
     * e.g. (int) 511 => (int) 11
     *
     * @param int $value
     * @return int
     */
    public static function getKopecks(int $value): int
    {
        return (int) substr((string) $value, -2);
    }

    /**
     * Returns money integer formatted as string
     *
     * e.g. (int) 500 => (string) 5, 00 ₽
     *
     * @param mixed $value
     * @return string
     */
    public static function format(int $value): string
    {
        $number = self::split($value);
        $formatted = number_format((float) $number, 2, ',', ' ');
        return $formatted . ' ₽';
    }

    /**
     * Returns floated point string as integer, removing spaces
     *
     * @throws \Exception
     */
    public static function parse(string $value, int $precision = 4): int
    {
        $value = str_replace('₽', '', $value);
        $value = str_replace(' ', '', $value);
        $value = str_replace(',', '.', $value);

        if (!is_numeric($value)) {
            throw new \UnexpectedValueException('CRM OWN MoneyFormatter parsing: value is unexpected');
        }

        return self::roundMoneyString($value, $precision);
    }

    /**
     * Returns rounded money string for parser
     *
     * e.g. 8.55 => 855
     *
     * e.g. 9.5578 => 956
     *
     * @param string $value
     * @param int $precision
     * @return int
     */
    private static function roundMoneyString(string $value, int $precision): int
    {
        $negative = '';

        if ($value < 0) {
            $negative = '-';
            $value *= -1;
        }

        $value = strval($value);

        $dotPosition = strpos($value, '.');

        if (!$dotPosition) {
            return $value * 100;
        }

        $integer    = substr($value, 0, $dotPosition);
        $fractional = substr($value, $dotPosition + 1, $precision);

        return intval($negative . $integer . self::roundFractional($fractional));
    }

    /**
     * Returns rounded fractional part of the number
     *
     * e.g. '5678' => '57'
     *
     * e.g. '5555' => '55'
     *
     * @param string $fractional
     * @return string
     */
    private static function roundFractional(string $fractional): string
    {
        $strLength = strlen($fractional);

        if ($strLength === 2) {
            return $fractional;
        }

        $digitsArray = str_split($fractional);

        $decimals = self::rounder($digitsArray);

        return $decimals[0] . $decimals[1];
    }

    /**
     * Returns an array containing only two elements,
     * recursively reducing the number of elements
     * starting from the last element.
     * If the element is greater than 5, the previous one will be incremented
     *
     * e.g. [4, 5, 6] => [4, 6]
     *
     * [4, 5, 5] => [4, 5]
     *
     * [4, 4, 5, 6] => [4, 5]
     *
     * @param array $arrayOfDigits
     * @return array
     */
    private static function rounder(array $arrayOfDigits): array
    {
        $elements = count($arrayOfDigits);

        if ($elements <= 2) {
            return $arrayOfDigits;
        }

        $last = $elements - 1;

        if ($arrayOfDigits[$last] > 5) {
            //TODO: HALF_ROUND_UP, HALF_ROUND_DOWN
            $arrayOfDigits[$last - 1] += 1;
        }

        unset($arrayOfDigits[$last]);

        return self::rounder($arrayOfDigits);
    }
}
