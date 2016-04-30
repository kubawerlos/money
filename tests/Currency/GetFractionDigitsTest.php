<?php

namespace Tests\Currency;

use KubaWerlos\Money\Currency;

/**
 * @covers \KubaWerlos\Money\Currency::getFractionDigits
 */
class GetFractionDigitsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getFractionDigitsProvider
     * @param int $expectedFractionDigits
     * @param string $code
     * @test
     */
    public function getFractionDigits($expectedFractionDigits, $code)
    {
        $currency = new Currency($code);

        $actualFractionDigits = $currency->getFractionDigits();

        $this->assertSame($expectedFractionDigits, $actualFractionDigits);
    }

    /**
     * @return array
     */
    public function getFractionDigitsProvider()
    {
        return [
            [ 0, 'ADP' ],
            [ 2, 'AED' ],
            [ 2, 'AFA' ],
            [ 0, 'AFN' ],
            [ 2, 'ALK' ],
            [ 0, 'ALL' ],
            [ 0, 'AMD' ],
            [ 2, 'ANG' ],
            [ 2, 'AOA' ],
            [ 2, 'AOK' ],
            [ 2, 'AON' ],
            [ 2, 'AOR' ],
            [ 2, 'ARA' ],
            [ 2, 'ARL' ],
            [ 2, 'ARM' ],
            [ 2, 'ARP' ],
            [ 2, 'ARS' ],
            [ 2, 'ATS' ],
            [ 2, 'AUD' ],
            [ 2, 'AWG' ],
            [ 2, 'AZM' ],
            [ 2, 'AZN' ],
            [ 2, 'BAD' ],
            [ 2, 'BAM' ],
            [ 2, 'BAN' ],
            [ 2, 'BBD' ],
            [ 2, 'BDT' ],
            [ 2, 'BEC' ],
            [ 2, 'BEF' ],
            [ 2, 'BEL' ],
            [ 2, 'BGL' ],
            [ 2, 'BGM' ],
            [ 2, 'BGN' ],
            [ 2, 'BGO' ],
            [ 3, 'BHD' ],
            [ 0, 'BIF' ],
            [ 2, 'BMD' ],
            [ 2, 'BND' ],
            [ 2, 'BOB' ],
            [ 2, 'BOL' ],
            [ 2, 'BOP' ],
            [ 2, 'BOV' ],
            [ 2, 'BRB' ],
            [ 2, 'BRC' ],
            [ 2, 'BRE' ],
            [ 2, 'BRL' ],
            [ 2, 'BRN' ],
            [ 2, 'BRR' ],
            [ 2, 'BRZ' ],
            [ 2, 'BSD' ],
            [ 2, 'BTN' ],
            [ 2, 'BUK' ],
            [ 2, 'BWP' ],
            [ 2, 'BYB' ],
            [ 0, 'BYR' ],
            [ 2, 'BZD' ],
            [ 2, 'CAD' ],
            [ 2, 'CDF' ],
            [ 2, 'CHE' ],
            [ 2, 'CHF' ],
            [ 2, 'CHW' ],
            [ 2, 'CLE' ],
            [ 4, 'CLF' ],
            [ 0, 'CLP' ],
            [ 2, 'CNX' ],
            [ 2, 'CNY' ],
            [ 0, 'COP' ],
            [ 2, 'COU' ],
            [ 0, 'CRC' ],
            [ 2, 'CSD' ],
            [ 2, 'CSK' ],
            [ 2, 'CUC' ],
            [ 2, 'CUP' ],
            [ 2, 'CVE' ],
            [ 2, 'CYP' ],
            [ 2, 'CZK' ],
            [ 2, 'DDM' ],
            [ 2, 'DEM' ],
            [ 0, 'DJF' ],
            [ 2, 'DKK' ],
            [ 2, 'DOP' ],
            [ 2, 'DZD' ],
            [ 2, 'ECS' ],
            [ 2, 'ECV' ],
            [ 2, 'EEK' ],
            [ 2, 'EGP' ],
            [ 2, 'ERN' ],
            [ 2, 'ESA' ],
            [ 2, 'ESB' ],
            [ 0, 'ESP' ],
            [ 2, 'ETB' ],
            [ 2, 'EUR' ],
            [ 2, 'FIM' ],
            [ 2, 'FJD' ],
            [ 2, 'FKP' ],
            [ 2, 'FRF' ],
            [ 2, 'GBP' ],
            [ 2, 'GEK' ],
            [ 2, 'GEL' ],
            [ 2, 'GHC' ],
            [ 2, 'GHS' ],
            [ 2, 'GIP' ],
            [ 2, 'GMD' ],
            [ 0, 'GNF' ],
            [ 2, 'GNS' ],
            [ 2, 'GQE' ],
            [ 2, 'GRD' ],
            [ 2, 'GTQ' ],
            [ 2, 'GWE' ],
            [ 2, 'GWP' ],
            [ 0, 'GYD' ],
            [ 2, 'HKD' ],
            [ 2, 'HNL' ],
            [ 2, 'HRD' ],
            [ 2, 'HRK' ],
            [ 2, 'HTG' ],
            [ 0, 'HUF' ],
            [ 0, 'IDR' ],
            [ 2, 'IEP' ],
            [ 2, 'ILP' ],
            [ 2, 'ILR' ],
            [ 2, 'ILS' ],
            [ 2, 'INR' ],
            [ 0, 'IQD' ],
            [ 0, 'IRR' ],
            [ 2, 'ISJ' ],
            [ 0, 'ISK' ],
            [ 0, 'ITL' ],
            [ 2, 'JMD' ],
            [ 3, 'JOD' ],
            [ 0, 'JPY' ],
            [ 2, 'KES' ],
            [ 2, 'KGS' ],
            [ 2, 'KHR' ],
            [ 0, 'KMF' ],
            [ 0, 'KPW' ],
            [ 2, 'KRH' ],
            [ 2, 'KRO' ],
            [ 0, 'KRW' ],
            [ 3, 'KWD' ],
            [ 2, 'KYD' ],
            [ 2, 'KZT' ],
            [ 0, 'LAK' ],
            [ 0, 'LBP' ],
            [ 2, 'LKR' ],
            [ 2, 'LRD' ],
            [ 2, 'LSL' ],
            [ 2, 'LTL' ],
            [ 2, 'LTT' ],
            [ 2, 'LUC' ],
            [ 0, 'LUF' ],
            [ 2, 'LUL' ],
            [ 2, 'LVL' ],
            [ 2, 'LVR' ],
            [ 3, 'LYD' ],
            [ 2, 'MAD' ],
            [ 2, 'MAF' ],
            [ 2, 'MCF' ],
            [ 2, 'MDC' ],
            [ 2, 'MDL' ],
            [ 0, 'MGA' ],
            [ 0, 'MGF' ],
            [ 2, 'MKD' ],
            [ 2, 'MKN' ],
            [ 2, 'MLF' ],
            [ 0, 'MMK' ],
            [ 0, 'MNT' ],
            [ 2, 'MOP' ],
            [ 0, 'MRO' ],
            [ 2, 'MTL' ],
            [ 2, 'MTP' ],
            [ 0, 'MUR' ],
            [ 2, 'MVP' ],
            [ 2, 'MVR' ],
            [ 2, 'MWK' ],
            [ 2, 'MXN' ],
            [ 2, 'MXP' ],
            [ 2, 'MXV' ],
            [ 2, 'MYR' ],
            [ 2, 'MZE' ],
            [ 2, 'MZM' ],
            [ 2, 'MZN' ],
            [ 2, 'NAD' ],
            [ 2, 'NGN' ],
            [ 2, 'NIC' ],
            [ 2, 'NIO' ],
            [ 2, 'NLG' ],
            [ 2, 'NOK' ],
            [ 2, 'NPR' ],
            [ 2, 'NZD' ],
            [ 3, 'OMR' ],
            [ 2, 'PAB' ],
            [ 2, 'PEI' ],
            [ 2, 'PEN' ],
            [ 2, 'PES' ],
            [ 2, 'PGK' ],
            [ 2, 'PHP' ],
            [ 0, 'PKR' ],
            [ 2, 'PLN' ],
            [ 2, 'PLZ' ],
            [ 2, 'PTE' ],
            [ 0, 'PYG' ],
            [ 2, 'QAR' ],
            [ 2, 'RHD' ],
            [ 2, 'ROL' ],
            [ 2, 'RON' ],
            [ 0, 'RSD' ],
            [ 2, 'RUB' ],
            [ 2, 'RUR' ],
            [ 0, 'RWF' ],
            [ 2, 'SAR' ],
            [ 2, 'SBD' ],
            [ 2, 'SCR' ],
            [ 2, 'SDD' ],
            [ 2, 'SDG' ],
            [ 2, 'SDP' ],
            [ 2, 'SEK' ],
            [ 2, 'SGD' ],
            [ 2, 'SHP' ],
            [ 2, 'SIT' ],
            [ 2, 'SKK' ],
            [ 0, 'SLL' ],
            [ 0, 'SOS' ],
            [ 2, 'SRD' ],
            [ 2, 'SRG' ],
            [ 2, 'SSP' ],
            [ 0, 'STD' ],
            [ 2, 'SUR' ],
            [ 2, 'SVC' ],
            [ 0, 'SYP' ],
            [ 2, 'SZL' ],
            [ 2, 'THB' ],
            [ 2, 'TJR' ],
            [ 2, 'TJS' ],
            [ 0, 'TMM' ],
            [ 2, 'TMT' ],
            [ 3, 'TND' ],
            [ 2, 'TOP' ],
            [ 2, 'TPE' ],
            [ 0, 'TRL' ],
            [ 2, 'TRY' ],
            [ 2, 'TTD' ],
            [ 2, 'TWD' ],
            [ 0, 'TZS' ],
            [ 2, 'UAH' ],
            [ 2, 'UAK' ],
            [ 2, 'UGS' ],
            [ 0, 'UGX' ],
            [ 2, 'USD' ],
            [ 2, 'USN' ],
            [ 2, 'USS' ],
            [ 0, 'UYI' ],
            [ 2, 'UYP' ],
            [ 2, 'UYU' ],
            [ 0, 'UZS' ],
            [ 2, 'VEB' ],
            [ 2, 'VEF' ],
            [ 0, 'VND' ],
            [ 2, 'VNN' ],
            [ 0, 'VUV' ],
            [ 2, 'WST' ],
            [ 0, 'XAF' ],
            [ 2, 'XCD' ],
            [ 2, 'XEU' ],
            [ 2, 'XFO' ],
            [ 2, 'XFU' ],
            [ 0, 'XOF' ],
            [ 0, 'XPF' ],
            [ 2, 'XRE' ],
            [ 2, 'YDD' ],
            [ 0, 'YER' ],
            [ 2, 'YUD' ],
            [ 2, 'YUM' ],
            [ 2, 'YUN' ],
            [ 2, 'YUR' ],
            [ 2, 'ZAL' ],
            [ 2, 'ZAR' ],
            [ 0, 'ZMK' ],
            [ 2, 'ZMW' ],
            [ 2, 'ZRN' ],
            [ 2, 'ZRZ' ],
            [ 0, 'ZWD' ],
            [ 2, 'ZWL' ],
            [ 2, 'ZWR' ],
        ];
    }
}
