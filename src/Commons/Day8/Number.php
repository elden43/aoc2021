<?php

namespace Day8;

class Number
{
    public const A = 'a';
    public const B = 'b';
    public const C = 'c';
    public const D = 'd';
    public const E = 'e';
    public const F = 'f';
    public const G = 'g';
    
    public const LETTER_VALUES = [
        self::A => 1,
        self::B => 2,
        self::C => 4,
        self::D => 8,
        self::E => 16,
        self::F => 32,
        self::G => 64,
        
    
    ];
    
    public int $letterValue = 0;
    public string $stringValue;
    
    public function __construct(string $input) { 
        $this->stringValue = $input;
        foreach (str_split($input) as $letter) {
            $this->letterValue += self::LETTER_VALUES[$letter];
        }
    }

    public function getBinaryValue(): string
    {
        return str_pad(decbin($this->letterValue), 7, 0, STR_PAD_LEFT);
    }

    public function getLength(): int
    {
        return strlen($this->stringValue);
    }
}