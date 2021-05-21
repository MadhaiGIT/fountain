<?php

namespace App\Libraries\Fountain;
/**
 * This class has all the basic functions needed by all other classes.
 *
 * Class FountainBase
 */
class FountainBase
{
    static private $unitTestCount = 0;
    static private $unitTestSuccess = 0;
    static private $unitTestFail = 0;

    /**
     * Use this for fields that have a int format with NULL permitted. Correctly returns int or null
     * @param int $intFromSql
     * @return null|int
     */
    public static function fixIntOrNullResultFromSql($intFromSql)
    {
        return (is_null($intFromSql)) ? NULL : (int)$intFromSql;
    }

    /**
     * Use this for fields that have a string format with NULL permitted. Correctly returns string or null
     * @param string $stringFromSql
     * @return null|string
     */
    public static function fixStringOrNullResultFromSql($stringFromSql)
    {
        return (is_null($stringFromSql)) ? NULL : (string)$stringFromSql;
    }

    /**
     * Use this for fields that have a bool format with NULL permitted. Correctly returns bool or null
     * @param bool $boolFromSql
     * @return null|string
     */
    public static function fixBoolOrNullResultFromSql($boolFromSql)
    {

        return (is_null($boolFromSql)) ? NULL : (bool)$boolFromSql;
    }

    /**
     * Correctly returns a datetime string or null
     * @param string $datetimeFromMySql
     * @return null|string
     */
    public static function fixDateTimeResultFromSql($datetimeFromMySql)
    {

        if (is_null($datetimeFromMySql)) return NULL;

        //Check if default null string value was used, and if so save as NULL.
        $datetimeFromMySql = (string)$datetimeFromMySql;
        if ($datetimeFromMySql == "0000-00-00 00:00:00") $datetimeFromMySql = NULL;

        return $datetimeFromMySql;
    }

    /**
     * Safely serialize data that has international characters. Warning! This function can only be used with arrays
     * @param array $dataArray
     * @return string
     */
    public static function safeSerialize($dataArray)
    {
        return json_encode($dataArray);
    }

    /**
     * Must be used to unserialize data encoded with safeSerialize
     * @param string $encodedSafeSerializedString
     * @return array
     */
    public static function safeUnserialize($encodedSafeSerializedString)
    {
        //return array
        return json_decode($encodedSafeSerializedString, true);
    }

    /**
     * unit test function to check given string is a datetime or not
     * @param string $testName
     * @param string $datetime
     * @return bool
     * @unit-test: unnecessary;
     */
    public static function UnitTestIsDatetimeString($testName, $datetime)
    {
        self::$unitTestCount++;

        //Is date?
        $result = (date('Y-m-d H:i:s', strtotime($datetime)) == $datetime);

        if ($result) {
            Utils::Debug("<br><span style='color: green; font-weight: bold;'>PASS</span> $testName: ('$datetime')");
            self::$unitTestSuccess++;
            return true;
        } else {
            Utils::Debug("<br><span style='color: red; font-weight: bold;'>FAIL</span> $testName: (Expected: Date; Result: '$datetime' ");
            self::$unitTestFail++;
            return false;
        }
    }

    /**
     * @param string $testName
     * @param string $expected
     * @param string $result
     * @return bool
     * @unit-test: unnecessary;
     */
    public static function UnitTestCompare($testName, $expected, $result)
    {
        self::$unitTestCount++;

        if ($expected === $result) {
            Utils::Debug("<br><span style='color: green; font-weight: bold;'>PASS</span> $testName; Result: (" . var_export($result, true) . "); ");
            self::$unitTestSuccess++;
            return true;
        } else {
            Utils::Debug("<br><span style='color: red; font-weight: bold;'>FAIL</span> $testName: (Expected: '$expected'; Result: " . var_export($result, true) . ". Serialized: " . serialize($result) . "' ");
            self::$unitTestFail++;
            return false;
        }
    }

    public static function UnitTestReport()
    {
        if (self::$unitTestFail == 0) {
            return "Success 100% (" . self::$unitTestSuccess . " Unit Tests Passed)";
        } else {
            return self::$unitTestFail . " Unit Test Failed ( " . self::$unitTestSuccess . " Passed )";
        }
    }

    public static function UnitTestPopulateDatabase()
    {
        // Complete
    }

}
