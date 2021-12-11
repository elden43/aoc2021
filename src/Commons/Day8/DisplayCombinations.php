<?php

namespace Day8;


class DisplayCombinations
{
    /** @var \Day8\Number[] $knowns */
    private array $knowns = [];

    /** @var \Day8\Number[] $unknowns */
    private array $unknowns = [];

    /**
     * @var string[] $identifiedSegments Real value => current display value
     */
    private array $identifiedSegments = [
        Number::A => "",
        Number::B => "",
        Number::C => "",
        Number::D => "",
        Number::E => "",
        Number::F => "",
        Number::G => "",

    ];
    /** @var \Day8\Number[]  */
    private array $resultValues;

    private function addToUnknowns(Number $number): void
    {
        $this->unknowns[] = $number;
    }    

    public function __construct(array $unknowns, array $results)
    {
        foreach ($unknowns as $unknown) {
            $this->addToUnknowns(new Number($unknown));
        }

        foreach ($results as $result) {
            $this->addToResultValues(new Number($result));
        }
    }

    private function identify1478(): void
    {
        foreach ($this->unknowns as $key => $number) {
            if ($number->getLength() === 2) {
                $this->knowns[1] = $number;
                unset($this->unknowns[$key]);
            }
            if ($number->getLength() === 3) {
                $this->knowns[7] = $number;
                unset($this->unknowns[$key]);
            }
            if ($number->getLength() === 4) {
                $this->knowns[4] = $number;
                unset($this->unknowns[$key]);
            }
            if ($number->getLength() === 7) {
                $this->knowns[8] = $number;
                unset($this->unknowns[$key]);
            }
        }
    }

    private function identify9(): void
    {
        foreach ($this->unknowns as $key => $number) {
            if ($number->getLength() === 6 && (($number->getBinaryValue() | $this->knowns[4]->getBinaryValue()) === $number->getBinaryValue())) {
                $this->knowns[9] = $number;
                unset($this->unknowns[$key]);
            }            
        }
    }    
    
    private function identifySegmentG(): void    
    {        
        $this->identifiedSegments[Number::G] = array_search($this->knowns[9]->letterValue & ~$this->knowns[4]->letterValue & ~$this->knowns[7]->letterValue, Number::LETTER_VALUES);                
    }

    private function identifySegmentE(): void
    {
        $this->identifiedSegments[Number::E] = array_search($this->knowns[8]->letterValue - $this->knowns[9]->letterValue, Number::LETTER_VALUES);
    }


    private function identify3(): void
    {
        foreach ($this->unknowns as $key => $number) {
            if ($number->getLength() === 5 && (($number->getBinaryValue() | $this->knowns[1]->getBinaryValue()) === $number->getBinaryValue())) {
                $this->knowns[3] = $number;
                unset($this->unknowns[$key]);
            }
        }
    }

    private function identifySegmentB(): void
    {
        $this->identifiedSegments[Number::B] = array_search($this->knowns[9]->letterValue & ~$this->knowns[3]->letterValue & ~Number::LETTER_VALUES[$this->identifiedSegments[Number::E]], Number::LETTER_VALUES);
    }

    private function identify0(): void
    {
        foreach ($this->unknowns as $key => $number) {
            if ($number->getLength() === 6 && (($number->letterValue & ~ Number::LETTER_VALUES[$this->identifiedSegments[Number::D]]) === $number->letterValue)) {
                $this->knowns[0] = $number;
                unset($this->unknowns[$key]);
            }
        }
    }

    private function identify6(): void
    {
        foreach ($this->unknowns as $key => $number) {
            if ($number->getLength() === 6) {
                $this->knowns[6] = $number;
                unset($this->unknowns[$key]);
            }
        }
    }

    private function identify2(): void
    {
        foreach ($this->unknowns as $key => $number) {
            if (($number->letterValue & ~ Number::LETTER_VALUES[$this->identifiedSegments[Number::B]]) === $number->letterValue) {
                $this->knowns[2] = $number;
                unset($this->unknowns[$key]);
            }
        }
    }

    private function identify5(): void
    {
        $this->unknowns = array_values($this->unknowns); //reset keys        
        $this->knowns[5] = $this->unknowns[0];
        unset($this->unknowns[0]);        
    }

    private function identifySegmentD(): void
    {       
        
        $this->identifiedSegments[Number::D] = array_search($this->knowns[4]->letterValue & ~Number::LETTER_VALUES[$this->identifiedSegments[Number::B]] & ~$this->knowns[1]->letterValue , Number::LETTER_VALUES);
    }

    private function addToResultValues(Number $result): void
    {
        $this->resultValues[] = $result;
    }

    private function processDecode(): void
    {
        $this->identify1478();
        $this->identify9();
        $this->identifySegmentG();
        $this->identifySegmentE();
        $this->identify3();
        $this->identifySegmentB();
        $this->identifySegmentD();
        $this->identify0();
        $this->identify6();
        $this->identify2();
        $this->identify5();
    }
    public function getResult(): int
    {
        $this->processDecode();
        
        $resultString = '';
        foreach ($this->resultValues as $resultValue) {
            foreach ($this->knowns as $key => $known) {
                if ($resultValue->letterValue === $known->letterValue) {
                    $resultString .= (string) $key;
                }
            } 
        }
        
        return (int) $resultString;
    }

    
}