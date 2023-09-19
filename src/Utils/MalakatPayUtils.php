<?php

namespace SyedNasharudin\MalakatPay\Utils;

class MalakatPayUtils
{
    /**
     * @param array $extras
     * @return array
     */
    public static function buildBodyRequest(array $extras) {
        $data = [];
        foreach ($extras as $key => $extra) {
            $data[$key != "page" ? "filter[$key]" : "page"] = $extra;
        }

        return $data;
    }
}