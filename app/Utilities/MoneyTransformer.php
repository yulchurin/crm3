<?php declare(strict_types=1);

namespace App\Utilities;

/**
 * Transforms money from integer into separated
 */
class MoneyTransformer
{
    public int $rubles;
    public int $kopecks;

    public function __construct(public int $value)
    {
        $this->rubles = (int) substr((string) $this->value, 0, -2);
        $this->kopecks = (int) substr((string) $this->value, -2);
    }

    public static function split(int $value): string
    {
        return substr((string) $value, 0, -2) .'.'. substr((string) $value, -2);
    }

    public static function getRubles(int $value): int
    {
        return (int) substr((string) $value, 0, -2);
    }

    public static function getKopecks(int $value): int
    {
        return (int) substr((string) $value, -2);
    }

    public static function getStringWithSymbol($value): string
    {
        $number = self::split($value);
        $formatted = number_format((float) $number, 2, ',', ' ');
        return $formatted . ' ₽';
    }
}
