<?php

namespace GisoStallenberg\PDOClauseHelper;

/**
 * The clause helper
 */
class ClauseHelper
{
    /**
     * Creates a new instance
     *
     * @return ClauseHelper
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Get the placeholder string for an IN clause and alters the values array so it maps the clause
     *
     * @param array $values
     * @param string $prefix
     * @return string
     */
    public function toInClausePlaceHolderString(array &$values, $prefix = null)
    {
        if (is_null($prefix)) {
            $prefix = 'parameter';
        }

        $resultArray = [];
        foreach (array_values($values) as $index => $value) {
            $name = sprintf(
                ':%s%s',
                $prefix,
                $index
            );
            $resultArray[$name] = $value;
        }
        $values = $resultArray; // overwrite referenced array

        return sprintf(
            '(%s)',
            implode(', ', array_keys($resultArray))
        );
    }
}
