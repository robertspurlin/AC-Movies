## Abstract
- For all three classes, I added validation of the paramaters where I saw fit to make debugging easier and to have those constraints defined. I added the validation to the setter functions for each parameter. 
- I adjusted all setters to be internal (protected) functions because the classes themselves should be responsible for validating their paramaters when they are initialized. If there is a use case to expose a setter, I wrote a public function that does nothing other than call the protected setter function for that parameter. All protected functions start with a `_` to make it easy to know whether it is for internal use only.

## Customer.php
- The logic that was calculating both the amounts and frequentRenterPoints, I saw better fit to move into Rental.php / have the Rental class be responsible for calculating it's own amount/price and renter points that it would add to an order. 

## Rental.php
- Changed the name of the `daysRented` parameter to `lengthInDays`. 
- amount and frequentRenterPoints are now being calculated on construct. I saw it better fit that Rental should calculate it's own amounts to charge and what frequentRenterPoints get applied instead of calculating it after the fact when needed.

## Movie.php
- Replaced priceCode with classification. My thinking is that a "movie classification" serves the use case of having some type of way to identify what type of movie it is better (for price calculations later) than the existing priceCode consts. 
- For ease of modifications to the classifications later on, the protected setter function is now validating against the possible classifications, a const array of the same name (`POSSIBLE_CLASSIFICATIONS`). Adding new classifications is as easy as 1. adding the classification to that array, and 2. adding the logic on how the amount should be calculated for that classification in Rental.php, `_calculateAmount()` function. 