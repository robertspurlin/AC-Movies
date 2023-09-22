<?php

class Customer
{
    private $name;
    private $rentals = array();

    public function __construct(string $name)
    {
        $this->_setName($name);
    }

    public function addRental(Rental $rental)
    {
        array_push($this->rentals, $rental);
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function _setName(string $name)
    {
        if ($name === "") {
            throw new InvalidArgumentException("Name cannot be an empty string");
        }

        $this->name = $name;
    }

    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        // determine amounts for each line
        foreach ($this->rentals as $rental) {

            // show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->getAmount() . "\n";
            $totalAmount += $rental->getAmount();

            $frequentRenterPoints += $rental->getRenterPoints();
        }

        // add footer lines
        $result .= "Amount owed is " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points";

        return $result;
    }
}
