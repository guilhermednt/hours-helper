<?php

namespace Donato\Hours;


class Parser
{

    /**
     * @param string $file
     * @return array
     */
    public static function parse($file)
    {
        $content = file_get_contents($file);

        return self::getHours($content);
    }

    private static function getHours($content)
    {
        if (preg_match_all('#^   [ 0-9][0-9].*$#m', $content, $m) > 0) {
            $days = reset($m);
        } else {
            throw new \RuntimeException('Invalid data. Missing daily entries.');
        }

        if (preg_match('#PERIODO DE: ([0-9/]+)#', $content, $m) > 0) {
            $firstDate = \DateTime::createFromFormat('d/m/Y', $m[1]);
            $nextMonth = clone $firstDate;
            $nextMonth->add(new \DateInterval('P1M'));
        } else {
            throw new \RuntimeException('Invalid data. Missing "PERIODO DE:"');
        }

        $hours = [];
        $result = [];
        foreach ($days as $day) {
            $dayNumber = substr($day, 3, 2);
            if ($dayNumber < $firstDate->format('d')) {
                $currentDate = $nextMonth;
            } else {
                $currentDate = $firstDate;
            }
            $date = \DateTime::createFromFormat('H:i:s Y-m-d', $currentDate->format('00:00:00 Y-m-').$dayNumber);
            $dayObj = new Day($date);

            $dayObj
                ->setObs1(self::parseColumn($day, 6, 3, false))
                ->setObs2(self::parseColumn($day, 10, 1, false))
                ->addShift(
                    Shift::createFromStrings(
                        $date,
                        self::parseColumn($day, 12, 4),
                        self::parseColumn($day, 17, 4)
                    )
                )
                ->addShift(
                    Shift::createFromStrings(
                        $date,
                        self::parseColumn($day, 22, 4),
                        self::parseColumn($day, 27, 4)
                    )
                )
                ->addShift(
                    Shift::createFromStrings(
                        $date,
                        self::parseColumn($day, 33, 4),
                        self::parseColumn($day, 38, 4)
                    )
                )
                ->addShift(
                    Shift::createFromStrings(
                        $date,
                        self::parseColumn($day, 45, 4),
                        self::parseColumn($day, 50, 4)
                    )
                )
                ->addShift(
                    Shift::createFromStrings(
                        $date,
                        self::parseColumn($day, 57, 4),
                        self::parseColumn($day, 62, 4)
                    )
                )
                ->addShift(
                    Shift::createFromStrings(
                        $date,
                        self::parseColumn($day, 69, 4),
                        self::parseColumn($day, 74, 4)
                    )
                );

            $result[] = $dayObj;
        }

        return $result;
    }

    private static function parseColumn($line, $offset, $length, $isHour = true)
    {
        $string = substr($line, $offset, $length);
        if ($isHour && strlen(trim($string)) > 0) {
            return str_pad(trim($string), 4, '0', STR_PAD_LEFT);
        }

        return $string;
    }
}
