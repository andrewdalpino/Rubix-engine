<?php

namespace Rubix\ML\Transformers;

use Rubix\ML\DataType;

use function is_string;

/**
 * HTML Stripper
 *
 * Removes any HTML tags that may be in the text of a categorical variable.
 *
 * @category    Machine Learning
 * @package     Rubix/ML
 * @author      Andrew DalPino
 */
class HTMLStripper implements Transformer
{
    /**
     * A list of html tags that should not be stripped ex. ['p', 'br'].
     *
     * @var list<string>
     */
    protected array $allowedTags;

    /**
     * @param string[] $allowedTags
     */
    public function __construct(array $allowedTags = [])
    {
        $this->allowedTags = array_values($allowedTags);
    }

    /**
     * Return the data types that this transformer is compatible with.
     *
     * @internal
     *
     * @return list<\Rubix\ML\DataType>
     */
    public function compatibility() : array
    {
        return DataType::all();
    }

    /**
     * Transform the dataset in place.
     *
     * @param list<list<mixed>> $samples
     */
    public function transform(array &$samples) : void
    {
        foreach ($samples as &$sample) {
            foreach ($sample as &$value) {
                if (is_string($value)) {
                    $value = strip_tags($value, $this->allowedTags);
                }
            }
        }
    }

    /**
     * Return the string representation of the object.
     *
     * @return string
     */
    public function __toString() : string
    {
        return 'HTML Stripper (allowed tags: ' . implode(', ', $this->allowedTags) . ')';
    }
}
