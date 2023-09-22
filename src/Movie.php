<?php

class Movie
{
    private const POSSIBLE_CLASSIFICATIONS = ["Regular", "New Release", "Childrens"];

    private $title;
    private $classification;

    public function __construct(string $title, string $classification)
    {
        $this->_setTitle($title);
        $this->_setClassification($classification);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    protected function _setTitle(string $title)
    {
        if ($title === "") {
            throw new InvalidArgumentException("Title should not be an empty string");
        }

        $this->title = $title;
    }

    public function getClassification(): string 
    {
        return $this->classification;
    }

    protected function _setClassification(string $classification)
    {
        if ($classification === "") {
            throw new InvalidArgumentException("Classification should not be an empty string");
        }

        if (!in_array($classification, self::POSSIBLE_CLASSIFICATIONS)) {
            throw new UnexpectedValueException("Classification " + $classification + " does not exist");
        }

        $this->classification = $classification;
    }

    public function setClassification(string $classification)
    {
        $this->_setClassification($classification);
    }
}
