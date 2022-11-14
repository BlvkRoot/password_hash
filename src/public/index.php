<?php
    $HASH_START = '$2y$10$';
    $PASSWORD_HASH = "$HASH_START";
    // Adicionar restante dos alfabetos dentro do array, seguindo o mesmo padrão.
    // Uma chave maiúscula e outra minúscula

    $ALPHABETS_HASHTABLE = [
        "A" => "0wAbk",
        "a" => "adkOE",
        "B" => "kdk0P",
        "b" => "uiJDw",
    ];

    // Adicionar restante dos numeros dentro do array, seguindo o mesmo padrão.
    // Numberos até 10
    $NUMBERS_HASHTABLE = [
        "0" => "sdOVd",
        "1" => "DFldf",
        "2" => "USlkd",
        "3" => "JODkj",
    ];

    $userInput = 'tests';

    // Create array key value pairs that represent every Number, Alphabet and Symbols [$_!@/\|]
    // Split value and set its equivalent value from the hashTable
    // Then store the respective value in the Database
    // When Decrypting the value stored in the Database
    // We validate that the value stored in the Database is the same 
    // as the value stored in the hashTable [splitHashed value by '_']
    // Then if the values match we return True ELse False

    echo 'inputPassword::::: '. $userInput;
    echo '<br>';

    function encryptPassword($password, $alphabetsHashtable, &$passwordHash) {
        foreach(str_split($password) as $input) { 
            if (isset($alphabetsHashtable[$input]))
                $passwordHash .= $alphabetsHashtable[$input].'_';
            else
                $passwordHash.= $input . '_';
        }
    }
    // Execute the encryptPassword function
    encryptPassword($userInput, $ALPHABETS_HASHTABLE, $PASSWORD_HASH);
    echo 'encryptedPassword::::: '. $PASSWORD_HASH;

    function decryptHash($hashValue, $hashStart, $alphabetHashtable, $password = '') {
        $hashedValues = explode('_', explode($hashStart, $hashValue)[1]);
        $hashDecripted = '';
        foreach ($hashedValues as $value) {
            $foundValue = array_search($value, $alphabetHashtable);
            if ($foundValue) 
                $hashDecripted.= array_search($value, $alphabetHashtable)
            else 
                $hashDecripted.= $value;
        }
        echo '<br>';
        return $hashDecripted;
    }

    echo 'decryptedPassword::::: '. decryptHash($PASSWORD_HASH, $HASH_START, $ALPHABETS_HASHTABLE);