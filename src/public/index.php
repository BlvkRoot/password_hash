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

    /**
     * @param $password string
     * @param $alphabetsHashtable array
     * @param $passwordHash string
     * @return void
     * Essa função recebe como parametro a senha digitada, a tabela hash para alterar os valores
     * e por ultimo a referencia da senha criptografada
     * para questão de exemplo eu adicionei apenas o $ALPHABETS_HASHTABLE mas vai ser necessário passar
     * também o $NUMBERS_HASHTABLE e criar o $SYMBOLS_HASHTABLE
     */
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

        /**
     * @param $hashValue string
     * @param $hashStart string
     * @param $alphabetHashtable array
     * @param $password string
     * @return $hashDecripted string | boolean
     * Essa função recebe como parametro a senha criptografada, o hash inicial constante da senha
     * e por ultimo a tabela de Hash,
     * para questão de exemplo eu adicionei apenas o $ALPHABETS_HASHTABLE mas vai ser necessário passar
     * também o $NUMBERS_HASHTABLE e criar o $SYMBOLS_HASHTABLE isso para pegar os valores da senha 
     * antes de ser criptografada
     * o ultimo parametro $password por enquanto não tá sendo usado
     * mas caso ele se seje usado, então a função vair retornar um booleano,
     * retornando $hashDecripted === $password
     */
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

    // Finalmente comparar se o $userInput === decryptHash($PASSWORD_HASH, $HASH_START, $ALPHABETS_HASHTABLE);