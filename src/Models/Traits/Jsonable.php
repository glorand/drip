<?php

namespace Glorand\Drip\Models\Traits;

trait Jsonable
{
    public function jsonSerialize(): array
    {
        $response = [];
        $attributes = get_object_vars($this);
        foreach ($attributes as $attribute => $value) {
            if (is_array($value) && count($value)) {
                $response[$attribute] = $value;
            } elseif ($value instanceof \DateTime) {
                $response[$attribute] = $value->format(DATE_ISO8601);
            } elseif (!empty($value)) {
                $response[$attribute] = $value;
            }
        }

        return $response;
    }
}
