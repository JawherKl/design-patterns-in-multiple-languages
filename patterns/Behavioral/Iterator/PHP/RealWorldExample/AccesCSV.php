<?php

namespace patterns\Behavioral\Iterator\PHP\RealWorldExample;

/**
 * CSV File Iterator.
 *
 * @author Josh Lockhart
 */
class CsvIterator implements \Iterator
{
    const ROW_SIZE = 4096;

    /**
     * The pointer to the CSV file.
     *
     * @var resource
     */
    protected $filePointer = null;

    /**
     * The current element, which is returned on each iteration.
     *
     * @var array
     */
    protected $currentElement = null;

    /**
     * The row counter.
     *
     * @var int
     */
    protected $rowCounter = null;

    /**
     * The delimiter for the CSV file.
     *
     * @var string
     */
    protected $delimiter = null;

    /**
     * The constructor tries to open the CSV file. It throws an exception on
     * failure.
     *
     * @param string $file The CSV file.
     * @param string $delimiter The delimiter.
     *
     * @throws \Exception
     */
    public function __construct($file, $delimiter = ',')
    {
        if (!file_exists($file)) {
            throw new \Exception('The file "' . $file . '" does not exist.');
        }

        $this->filePointer = fopen($file, 'rb');
        if (!$this->filePointer) {
            throw new \Exception('The file "' . $file . '" cannot be read.');
        }
        $this->delimiter = $delimiter;
    }

    /**
     * This method resets the file pointer.
     */
    public function rewind(): void
    {
        if ($this->filePointer) {
            $this->rowCounter = 0;
            rewind($this->filePointer);
        }
    }

    /**
     * This method returns the current CSV row as a 2-dimensional array.
     *
     * @return array The current CSV row as a 2-dimensional array.
     */
    public function current(): array
    {
        // Read the current row from the CSV file
        $this->currentElement = fgetcsv($this->filePointer, self::ROW_SIZE, $this->delimiter);
        $this->rowCounter++;

        // Check if we reached EOF or there was an error while reading
        if ($this->currentElement === false) {
            return [];  // Return an empty array when reaching EOF or error
        }

        return $this->currentElement;
    }

    /**
     * This method returns the current row number.
     *
     * @return int The current row number.
     */
    public function key(): int
    {
        return $this->rowCounter;
    }

    /**
     * This method checks if the end of file has been reached.
     *
     * @return bool Returns true on EOF reached, false otherwise.
     */
    public function next(): bool
    {
        if (is_resource($this->filePointer)) {
            return !feof($this->filePointer);
        }

        return false;
    }

    /**
     * This method checks if the next row is a valid row.
     *
     * @return bool If the next row is a valid row.
     */
    public function valid(): bool
    {
        if (!$this->next()) {
            if (is_resource($this->filePointer)) {
                fclose($this->filePointer);
            }

            return false;
        }

        return true;
    }
}

/**
 * The client code.
 */
try {
    $csv = new CsvIterator(__DIR__ . '/cats.csv');

    foreach ($csv as $key => $row) {
        print_r($row);
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}