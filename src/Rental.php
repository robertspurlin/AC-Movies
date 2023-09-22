<?php

class Rental
{
    private $movie;
    private $lengthInDays;
    private $amount;
    private $renterPoints;

    public function __construct(Movie $movie, int $lengthInDays)
    {
        $this->_setMovie($movie);
        $this->_setlengthInDays($lengthInDays);
        $this->_calculateAmount();
        $this->_calculateRenterPoints();
    }

    public function getLengthInDays(): int
    {
        return $this->lengthInDays;
    }

    protected function _setlengthInDays(int $lengthInDays)
    {
        if ($lengthInDays < 0) {
            throw new InvalidArgumentException("Length of Rental must be more than zero");
        }

        $this->lengthInDays = $lengthInDays;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    protected function _setMovie(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getAmount(): float 
    {
        return $this->amount;
    }

    protected function _calculateAmount()
    {
        $amount = 0;

        switch ($this->getMovie()->getClassification()) {
            case "Regular":
                $amount += 2;
                if ($this->getLengthInDays() > 2) {
                    $amount += ($this->getLengthInDays() - 2) * 1.5;
                }
                break;

            case "New Release":
                $amount += $this->getLengthInDays() * 3;
                break;

            case "Childrens":
                $amount += 1.5;
                if ($this->getLengthInDays() > 3) {
                    $amount += ($this->getLengthInDays() - 3) * 1.5;
                }
                break;
            
            default:
                break;
        }

        $this->amount = $amount;
    }

    public function getRenterPoints(): int 
    {
        return $this->renterPoints;
    }

    protected function _calculateRenterPoints()
    {
        $points = 1;

        if ($this->getMovie()->getClassification() === "New Release" && $this->lengthInDays > 1) {
            $points++;
        }

        $this->renterPoints = $points;
    }
}
