<?php

namespace Rubix\ML\Other\Helpers;

/**
 * @internal
 */
class Console
{
    /**
     * The width of each cell in characters.
     *
     * @var int
     */
    public const TABLE_CELL_WIDTH = 11;

    /**
     * The command to return the number of rows that the current terminal supports.
     *
     * @var string
     */
    protected const SIZE_ROWS_COMMAND = 'tput lines';

    /**
     * The command to return the number of columns that the current terminal supports.
     *
     * @var string
     */
    protected const SIZE_COLUMNS_COMMAND = 'tput cols';

    /**
     * The default number of rows in the terminal.
     *
     * @var int
     */
    protected const DEFAULT_SIZE_ROWS = 24;

    /**
     * The default number of columns in the terminal.
     *
     * @var int
     */
    protected const DEFAULT_SIZE_COLUMNS = 80;

    /**
     * The prefix to every table cell.
     *
     * @var string
     */
    protected const TABLE_CELL_PREFIX = '| ';

    /**
     * The suffix of every table cell.
     *
     * @var string
     */
    protected const TABLE_CELL_SUFFIX = ' ';

    /**
     * Return the size of the console window in a 2-tuple.
     *
     * @return int[]
     */
    public static function size() : array
    {
        return [
            (int) exec(self::SIZE_ROWS_COMMAND) ?: self::DEFAULT_SIZE_ROWS,
            (int) exec(self::SIZE_COLUMNS_COMMAND) ?: self::DEFAULT_SIZE_COLUMNS,
        ];
    }

    /**
     * Return the string representation of a 2-dimensional data table.
     *
     * @param array[] $table
     * @param int $columnSize
     *
     * @return string
     */
    public static function table(array $table, int $columnSize) : string
    {
        $implodeRowCallback = static function (string $carry, array $row) use ($columnSize) {
            $border = str_repeat(str_repeat('-', $columnSize - 1), count($row)) . '-';

            $formatCellCallback = static function (string $carry, string $value) use ($columnSize) {
                $value = str_pad(substr($value, 0, $columnSize - 4), $columnSize - 4);

                return $carry . self::TABLE_CELL_PREFIX . $value . self::TABLE_CELL_SUFFIX;
            };

            $temp = array_reduce(array_map('strval', $row), $formatCellCallback, '');

            return $carry . PHP_EOL . $temp . '|' . PHP_EOL . $border;
        };

        return array_reduce($table, $implodeRowCallback, '') . PHP_EOL;
    }
}
