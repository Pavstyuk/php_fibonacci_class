<?php

class Fibonacсi
{
    public $max;
    public $series;
    private $codeStarted;
    private $codeEnded;

    public function __construct(int $max)
    {

        if ((int)$max >= 1) {
            $this->max = $max;
        } else {
            $this->max = 10;
        }
        $this->series = $this->buildSeries();
    }

    public function buildSeries(): array
    {
        $this->codeStarted = microtime(true);

        $row = array(1 => 1, 2 => 2);

        for ($i = 3; $i <= $this->max; $i++) {
            $item = $row[$i - 2] + $row[$i - 1];
            array_push($row, $item);
        }

        $this->codeEnded = microtime(true);

        return $row;
    }

    public function printSeries()
    {
        echo "<pre>";
        print_r($this->series);
        echo "</pre>";
    }

    public function printSeriesCli()
    {
        print_r($this->series);
    }


    public function printSeriesRange(int $from, int $to)
    {

        if (!$from || $from < 0 || $from > $to) {
            $from = 1;
        }

        if (!$to || $to > $this->max || $to < $from) {
            $to = $this->max;
        } else {
            $to = $to - $from;
        }

        $range = array_slice($this->series, ($from - 1), ($to + 1), true);

        echo "<pre>";
        print_r($range);
        echo "</pre>";
    }

    public function printSeriesRangeCli(int $from, int $to)
    {

        if (!$from || $from < 0 || $from > $to) {
            $from = 1;
        }

        if (!$to || $to > $this->max || $to < $from) {
            $to = $this->max;
        } else {
            $to = $to - $from;
        }

        $range = array_slice($this->series, ($from - 1), ($to + 1), true);

        print_r($range);
    }

    public function calculateExec()
    {
        return round((float)($this->codeEnded - $this->codeStarted) * 1000, 6) . " ms";
    }

    public function writeToFile(string $file_name = "fibonacci.txt")
    {
        touch($file_name);

        $result = file_put_contents($file_name, json_encode($this->series));

        return $result ? true : false;
    }
}
