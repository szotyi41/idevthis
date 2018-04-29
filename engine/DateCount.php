<?php
/**
 * Created by PhpStorm.
 * User: Szotyi Lehet
 * Date: 2018. 04. 22.
 * Time: 1:18
 */

namespace Engine;

abstract class DateCount
{

    /**
     * Get normal date Like 2017. Február. 21. 16:30
     * @param \DateTime $date
     * @return string
     */
    public static function getNormal(\DateTime $date)
    {
        $months = Array("Január", "Február", "Március", "Április", "Május", "Június", "Július", "Augusztus", "Szeptember", "Október", "November", "December");
        $result = $date->format("Y.") . WS;
        $result .= $months[(integer)$date->format("m") - 1] . WS;
        $result .= $date->format("d.") . WS;
        $result .= $date->format("H:i");

        return $result;
    }
}