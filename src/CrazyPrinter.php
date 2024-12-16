<?php

namespace Belkin\Tilda;

/**
 * Инструмент для вывода чисел
 *
 * @author Alexandr Belkin <belkindeveloper@gmail.com>
 */
class CrazyPrinter
{
    /**
     * Выводит целые числа по порядку от первого до последнего в несколько строк так,
     * что первая строка содержит одно число, а каждая последующая строка - на одно число больше.
     * Пробелы между числами ставятся в таком количестве, чтобы столбцы лесенки были ровными.
     *
     * @param int $first Первое число лесенки
     * @param int $last   Последнее число лесенки
     *
     * @return void
     */
    public static function printLadder(int $first, int $last): void
    {
        $lineLength = 1;
        $currentLineLength = 0;
        for ($number = $first; $number <= $last; $number += 1) {
            echo $number;
            for ($i = 1; $i <= strlen((string)$last) - strlen((string)$number) + 1; $i += 1) {
                echo ' ';
            }
            $currentLineLength += 1;
            if ($currentLineLength === $lineLength) {
                if ($number !== $last) {
                    echo PHP_EOL;
                }
                $currentLineLength = 0;
                $lineLength += 1;
            }
        }
        echo PHP_EOL;
    }

    /**
     * Выводит $width x $height случайных чисел от 1 до 1000 с разбивкой по строкам
     *
     * Был опробован альтернативный вариант решения (метод ниже) через нарезку
     * перемешанного диапазона на слайсы. Но он оказался медленнее по замерам, чем это решение "в лоб".
     *
     * @param int $width  Количество чисел в строке
     * @param int $height Количество строк
     *
     * @return void
     */
    public static function printRandomNumbersTable(int $width, int $height): void
    {
        $table = [];
        $set = [];
        for ($i = 0; $i < $height; $i += 1) {
            for ($j = 0; $j < $width; $j += 1) {
                do {
                    $number = rand(1, 1000);
                } while (!empty($set[$number]));
                $set[$number] = true;
                $table[$i][$j] = $number;
                echo $number;
                for ($k = 1; $k < 6 - strlen((string)$number); $k += 1) {
                    echo ' ';
                }
            }
            echo PHP_EOL;
        }
    }

    /**
     * Выводит $width x $height уникальных случайных чисел от 1 до 1000 с разбивкой по строкам
     *
     * @param int $width  Количество чисел в строке
     * @param int $height Количество строк
     *
     * @return void
     *
     * @deprecated
     */
    public static function printRandomNumbersTableFromRange(int $width, int $height): void
    {
        $range = range(1, 1000);
        shuffle($range);
        $table = [];
        for ($i = 0; $i < $height; $i += 1) {
            $table[$i] = array_slice($range, $i * $width, $width);
        }
        for ($i = 0; $i < $height; $i += 1) {
            for ($j = 0; $j < $width; $j += 1) {
                echo $table[$i][$j];
                for ($k = 1; $k < 6 - strlen((string)($table[$i][$j])); $k += 1) {
                    echo ' ';
                }
            }
            echo PHP_EOL;
        }
    }
}
