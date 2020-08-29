<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'code' => 'AF',
                'deleted_at' => NULL,
                'id' => 1,
                'name' => 'Afghanistan',
                'order' => 0,
                'phonecode' => 93,
            ),
            1 => 
            array (
                'code' => 'AL',
                'deleted_at' => NULL,
                'id' => 2,
                'name' => 'Albania',
                'order' => 0,
                'phonecode' => 355,
            ),
            2 => 
            array (
                'code' => 'DZ',
                'deleted_at' => NULL,
                'id' => 3,
                'name' => 'Algeria',
                'order' => 0,
                'phonecode' => 213,
            ),
            3 => 
            array (
                'code' => 'AS',
                'deleted_at' => NULL,
                'id' => 4,
                'name' => 'American Samoa',
                'order' => 0,
                'phonecode' => 1684,
            ),
            4 => 
            array (
                'code' => 'AD',
                'deleted_at' => NULL,
                'id' => 5,
                'name' => 'Andorra',
                'order' => 0,
                'phonecode' => 376,
            ),
            5 => 
            array (
                'code' => 'AO',
                'deleted_at' => NULL,
                'id' => 6,
                'name' => 'Angola',
                'order' => 0,
                'phonecode' => 244,
            ),
            6 => 
            array (
                'code' => 'AI',
                'deleted_at' => NULL,
                'id' => 7,
                'name' => 'Anguilla',
                'order' => 0,
                'phonecode' => 1264,
            ),
            7 => 
            array (
                'code' => 'AQ',
                'deleted_at' => NULL,
                'id' => 8,
                'name' => 'Antarctica',
                'order' => 0,
                'phonecode' => 0,
            ),
            8 => 
            array (
                'code' => 'AG',
                'deleted_at' => NULL,
                'id' => 9,
                'name' => 'Antigua And Barbuda',
                'order' => 0,
                'phonecode' => 1268,
            ),
            9 => 
            array (
                'code' => 'AR',
                'deleted_at' => NULL,
                'id' => 10,
                'name' => 'Argentina',
                'order' => 0,
                'phonecode' => 54,
            ),
            10 => 
            array (
                'code' => 'AM',
                'deleted_at' => NULL,
                'id' => 11,
                'name' => 'Armenia',
                'order' => 0,
                'phonecode' => 374,
            ),
            11 => 
            array (
                'code' => 'AW',
                'deleted_at' => NULL,
                'id' => 12,
                'name' => 'Aruba',
                'order' => 0,
                'phonecode' => 297,
            ),
            12 => 
            array (
                'code' => 'AU',
                'deleted_at' => NULL,
                'id' => 13,
                'name' => 'Australia',
                'order' => 0,
                'phonecode' => 61,
            ),
            13 => 
            array (
                'code' => 'AT',
                'deleted_at' => NULL,
                'id' => 14,
                'name' => 'Austria',
                'order' => 0,
                'phonecode' => 43,
            ),
            14 => 
            array (
                'code' => 'AZ',
                'deleted_at' => NULL,
                'id' => 15,
                'name' => 'Azerbaijan',
                'order' => 0,
                'phonecode' => 994,
            ),
            15 => 
            array (
                'code' => 'BS',
                'deleted_at' => NULL,
                'id' => 16,
                'name' => 'Bahamas The',
                'order' => 0,
                'phonecode' => 1242,
            ),
            16 => 
            array (
                'code' => 'BH',
                'deleted_at' => NULL,
                'id' => 17,
                'name' => 'Bahrain',
                'order' => 0,
                'phonecode' => 973,
            ),
            17 => 
            array (
                'code' => 'BD',
                'deleted_at' => NULL,
                'id' => 18,
                'name' => 'Bangladesh',
                'order' => 0,
                'phonecode' => 880,
            ),
            18 => 
            array (
                'code' => 'BB',
                'deleted_at' => NULL,
                'id' => 19,
                'name' => 'Barbados',
                'order' => 0,
                'phonecode' => 1246,
            ),
            19 => 
            array (
                'code' => 'BY',
                'deleted_at' => NULL,
                'id' => 20,
                'name' => 'Belarus',
                'order' => 0,
                'phonecode' => 375,
            ),
            20 => 
            array (
                'code' => 'BE',
                'deleted_at' => NULL,
                'id' => 21,
                'name' => 'Belgium',
                'order' => 0,
                'phonecode' => 32,
            ),
            21 => 
            array (
                'code' => 'BZ',
                'deleted_at' => NULL,
                'id' => 22,
                'name' => 'Belize',
                'order' => 0,
                'phonecode' => 501,
            ),
            22 => 
            array (
                'code' => 'BJ',
                'deleted_at' => NULL,
                'id' => 23,
                'name' => 'Benin',
                'order' => 0,
                'phonecode' => 229,
            ),
            23 => 
            array (
                'code' => 'BM',
                'deleted_at' => NULL,
                'id' => 24,
                'name' => 'Bermuda',
                'order' => 0,
                'phonecode' => 1441,
            ),
            24 => 
            array (
                'code' => 'BT',
                'deleted_at' => NULL,
                'id' => 25,
                'name' => 'Bhutan',
                'order' => 0,
                'phonecode' => 975,
            ),
            25 => 
            array (
                'code' => 'BO',
                'deleted_at' => NULL,
                'id' => 26,
                'name' => 'Bolivia',
                'order' => 0,
                'phonecode' => 591,
            ),
            26 => 
            array (
                'code' => 'BA',
                'deleted_at' => NULL,
                'id' => 27,
                'name' => 'Bosnia and Herzegovina',
                'order' => 0,
                'phonecode' => 387,
            ),
            27 => 
            array (
                'code' => 'BW',
                'deleted_at' => NULL,
                'id' => 28,
                'name' => 'Botswana',
                'order' => 0,
                'phonecode' => 267,
            ),
            28 => 
            array (
                'code' => 'BV',
                'deleted_at' => NULL,
                'id' => 29,
                'name' => 'Bouvet Island',
                'order' => 0,
                'phonecode' => 0,
            ),
            29 => 
            array (
                'code' => 'BR',
                'deleted_at' => NULL,
                'id' => 30,
                'name' => 'Brazil',
                'order' => 0,
                'phonecode' => 55,
            ),
            30 => 
            array (
                'code' => 'IO',
                'deleted_at' => NULL,
                'id' => 31,
                'name' => 'British Indian Ocean Territory',
                'order' => 0,
                'phonecode' => 246,
            ),
            31 => 
            array (
                'code' => 'BN',
                'deleted_at' => NULL,
                'id' => 32,
                'name' => 'Brunei',
                'order' => 0,
                'phonecode' => 673,
            ),
            32 => 
            array (
                'code' => 'BG',
                'deleted_at' => NULL,
                'id' => 33,
                'name' => 'Bulgaria',
                'order' => 0,
                'phonecode' => 359,
            ),
            33 => 
            array (
                'code' => 'BF',
                'deleted_at' => NULL,
                'id' => 34,
                'name' => 'Burkina Faso',
                'order' => 0,
                'phonecode' => 226,
            ),
            34 => 
            array (
                'code' => 'BI',
                'deleted_at' => NULL,
                'id' => 35,
                'name' => 'Burundi',
                'order' => 0,
                'phonecode' => 257,
            ),
            35 => 
            array (
                'code' => 'KH',
                'deleted_at' => NULL,
                'id' => 36,
                'name' => 'Cambodia',
                'order' => 0,
                'phonecode' => 855,
            ),
            36 => 
            array (
                'code' => 'CM',
                'deleted_at' => NULL,
                'id' => 37,
                'name' => 'Cameroon',
                'order' => 0,
                'phonecode' => 237,
            ),
            37 => 
            array (
                'code' => 'CA',
                'deleted_at' => NULL,
                'id' => 38,
                'name' => 'Canada',
                'order' => 0,
                'phonecode' => 1,
            ),
            38 => 
            array (
                'code' => 'CV',
                'deleted_at' => NULL,
                'id' => 39,
                'name' => 'Cape Verde',
                'order' => 0,
                'phonecode' => 238,
            ),
            39 => 
            array (
                'code' => 'KY',
                'deleted_at' => NULL,
                'id' => 40,
                'name' => 'Cayman Islands',
                'order' => 0,
                'phonecode' => 1345,
            ),
            40 => 
            array (
                'code' => 'CF',
                'deleted_at' => NULL,
                'id' => 41,
                'name' => 'Central African Republic',
                'order' => 0,
                'phonecode' => 236,
            ),
            41 => 
            array (
                'code' => 'TD',
                'deleted_at' => NULL,
                'id' => 42,
                'name' => 'Chad',
                'order' => 0,
                'phonecode' => 235,
            ),
            42 => 
            array (
                'code' => 'CL',
                'deleted_at' => NULL,
                'id' => 43,
                'name' => 'Chile',
                'order' => 0,
                'phonecode' => 56,
            ),
            43 => 
            array (
                'code' => 'CN',
                'deleted_at' => NULL,
                'id' => 44,
                'name' => 'China',
                'order' => 0,
                'phonecode' => 86,
            ),
            44 => 
            array (
                'code' => 'CX',
                'deleted_at' => NULL,
                'id' => 45,
                'name' => 'Christmas Island',
                'order' => 0,
                'phonecode' => 61,
            ),
            45 => 
            array (
                'code' => 'CC',
                'deleted_at' => NULL,
                'id' => 46,
            'name' => 'Cocos (Keeling) Islands',
                'order' => 0,
                'phonecode' => 672,
            ),
            46 => 
            array (
                'code' => 'CO',
                'deleted_at' => NULL,
                'id' => 47,
                'name' => 'Colombia',
                'order' => 0,
                'phonecode' => 57,
            ),
            47 => 
            array (
                'code' => 'KM',
                'deleted_at' => NULL,
                'id' => 48,
                'name' => 'Comoros',
                'order' => 0,
                'phonecode' => 269,
            ),
            48 => 
            array (
                'code' => 'CG',
                'deleted_at' => NULL,
                'id' => 49,
                'name' => 'Congo',
                'order' => 0,
                'phonecode' => 242,
            ),
            49 => 
            array (
                'code' => 'CD',
                'deleted_at' => NULL,
                'id' => 50,
                'name' => 'Congo The Democratic Republic Of The',
                'order' => 0,
                'phonecode' => 242,
            ),
            50 => 
            array (
                'code' => 'CK',
                'deleted_at' => NULL,
                'id' => 51,
                'name' => 'Cook Islands',
                'order' => 0,
                'phonecode' => 682,
            ),
            51 => 
            array (
                'code' => 'CR',
                'deleted_at' => NULL,
                'id' => 52,
                'name' => 'Costa Rica',
                'order' => 0,
                'phonecode' => 506,
            ),
            52 => 
            array (
                'code' => 'CI',
                'deleted_at' => NULL,
                'id' => 53,
            'name' => 'Cote D Ivoire (Ivory Coast)',
                'order' => 0,
                'phonecode' => 225,
            ),
            53 => 
            array (
                'code' => 'HR',
                'deleted_at' => NULL,
                'id' => 54,
            'name' => 'Croatia (Hrvatska)',
                'order' => 0,
                'phonecode' => 385,
            ),
            54 => 
            array (
                'code' => 'CU',
                'deleted_at' => NULL,
                'id' => 55,
                'name' => 'Cuba',
                'order' => 0,
                'phonecode' => 53,
            ),
            55 => 
            array (
                'code' => 'CY',
                'deleted_at' => NULL,
                'id' => 56,
                'name' => 'Cyprus',
                'order' => 0,
                'phonecode' => 357,
            ),
            56 => 
            array (
                'code' => 'CZ',
                'deleted_at' => NULL,
                'id' => 57,
                'name' => 'Czech Republic',
                'order' => 0,
                'phonecode' => 420,
            ),
            57 => 
            array (
                'code' => 'DK',
                'deleted_at' => NULL,
                'id' => 58,
                'name' => 'Denmark',
                'order' => 0,
                'phonecode' => 45,
            ),
            58 => 
            array (
                'code' => 'DJ',
                'deleted_at' => NULL,
                'id' => 59,
                'name' => 'Djibouti',
                'order' => 0,
                'phonecode' => 253,
            ),
            59 => 
            array (
                'code' => 'DM',
                'deleted_at' => NULL,
                'id' => 60,
                'name' => 'Dominica',
                'order' => 0,
                'phonecode' => 1767,
            ),
            60 => 
            array (
                'code' => 'DO',
                'deleted_at' => NULL,
                'id' => 61,
                'name' => 'Dominican Republic',
                'order' => 0,
                'phonecode' => 1809,
            ),
            61 => 
            array (
                'code' => 'TP',
                'deleted_at' => NULL,
                'id' => 62,
                'name' => 'East Timor',
                'order' => 0,
                'phonecode' => 670,
            ),
            62 => 
            array (
                'code' => 'EC',
                'deleted_at' => NULL,
                'id' => 63,
                'name' => 'Ecuador',
                'order' => 0,
                'phonecode' => 593,
            ),
            63 => 
            array (
                'code' => 'EG',
                'deleted_at' => NULL,
                'id' => 64,
                'name' => 'Egypt',
                'order' => 0,
                'phonecode' => 20,
            ),
            64 => 
            array (
                'code' => 'SV',
                'deleted_at' => NULL,
                'id' => 65,
                'name' => 'El Salvador',
                'order' => 0,
                'phonecode' => 503,
            ),
            65 => 
            array (
                'code' => 'GQ',
                'deleted_at' => NULL,
                'id' => 66,
                'name' => 'Equatorial Guinea',
                'order' => 0,
                'phonecode' => 240,
            ),
            66 => 
            array (
                'code' => 'ER',
                'deleted_at' => NULL,
                'id' => 67,
                'name' => 'Eritrea',
                'order' => 0,
                'phonecode' => 291,
            ),
            67 => 
            array (
                'code' => 'EE',
                'deleted_at' => NULL,
                'id' => 68,
                'name' => 'Estonia',
                'order' => 0,
                'phonecode' => 372,
            ),
            68 => 
            array (
                'code' => 'ET',
                'deleted_at' => NULL,
                'id' => 69,
                'name' => 'Ethiopia',
                'order' => 0,
                'phonecode' => 251,
            ),
            69 => 
            array (
                'code' => 'XA',
                'deleted_at' => NULL,
                'id' => 70,
                'name' => 'External Territories of Australia',
                'order' => 0,
                'phonecode' => 61,
            ),
            70 => 
            array (
                'code' => 'FK',
                'deleted_at' => NULL,
                'id' => 71,
                'name' => 'Falkland Islands',
                'order' => 0,
                'phonecode' => 500,
            ),
            71 => 
            array (
                'code' => 'FO',
                'deleted_at' => NULL,
                'id' => 72,
                'name' => 'Faroe Islands',
                'order' => 0,
                'phonecode' => 298,
            ),
            72 => 
            array (
                'code' => 'FJ',
                'deleted_at' => NULL,
                'id' => 73,
                'name' => 'Fiji Islands',
                'order' => 0,
                'phonecode' => 679,
            ),
            73 => 
            array (
                'code' => 'FI',
                'deleted_at' => NULL,
                'id' => 74,
                'name' => 'Finland',
                'order' => 0,
                'phonecode' => 358,
            ),
            74 => 
            array (
                'code' => 'FR',
                'deleted_at' => NULL,
                'id' => 75,
                'name' => 'France',
                'order' => 0,
                'phonecode' => 33,
            ),
            75 => 
            array (
                'code' => 'GF',
                'deleted_at' => NULL,
                'id' => 76,
                'name' => 'French Guiana',
                'order' => 0,
                'phonecode' => 594,
            ),
            76 => 
            array (
                'code' => 'PF',
                'deleted_at' => NULL,
                'id' => 77,
                'name' => 'French Polynesia',
                'order' => 0,
                'phonecode' => 689,
            ),
            77 => 
            array (
                'code' => 'TF',
                'deleted_at' => NULL,
                'id' => 78,
                'name' => 'French Southern Territories',
                'order' => 0,
                'phonecode' => 0,
            ),
            78 => 
            array (
                'code' => 'GA',
                'deleted_at' => NULL,
                'id' => 79,
                'name' => 'Gabon',
                'order' => 0,
                'phonecode' => 241,
            ),
            79 => 
            array (
                'code' => 'GM',
                'deleted_at' => NULL,
                'id' => 80,
                'name' => 'Gambia The',
                'order' => 0,
                'phonecode' => 220,
            ),
            80 => 
            array (
                'code' => 'GE',
                'deleted_at' => NULL,
                'id' => 81,
                'name' => 'Georgia',
                'order' => 0,
                'phonecode' => 995,
            ),
            81 => 
            array (
                'code' => 'DE',
                'deleted_at' => NULL,
                'id' => 82,
                'name' => 'Germany',
                'order' => 0,
                'phonecode' => 49,
            ),
            82 => 
            array (
                'code' => 'GH',
                'deleted_at' => NULL,
                'id' => 83,
                'name' => 'Ghana',
                'order' => 0,
                'phonecode' => 233,
            ),
            83 => 
            array (
                'code' => 'GI',
                'deleted_at' => NULL,
                'id' => 84,
                'name' => 'Gibraltar',
                'order' => 0,
                'phonecode' => 350,
            ),
            84 => 
            array (
                'code' => 'GR',
                'deleted_at' => NULL,
                'id' => 85,
                'name' => 'Greece',
                'order' => 0,
                'phonecode' => 30,
            ),
            85 => 
            array (
                'code' => 'GL',
                'deleted_at' => NULL,
                'id' => 86,
                'name' => 'Greenland',
                'order' => 0,
                'phonecode' => 299,
            ),
            86 => 
            array (
                'code' => 'GD',
                'deleted_at' => NULL,
                'id' => 87,
                'name' => 'Grenada',
                'order' => 0,
                'phonecode' => 1473,
            ),
            87 => 
            array (
                'code' => 'GP',
                'deleted_at' => NULL,
                'id' => 88,
                'name' => 'Guadeloupe',
                'order' => 0,
                'phonecode' => 590,
            ),
            88 => 
            array (
                'code' => 'GU',
                'deleted_at' => NULL,
                'id' => 89,
                'name' => 'Guam',
                'order' => 0,
                'phonecode' => 1671,
            ),
            89 => 
            array (
                'code' => 'GT',
                'deleted_at' => NULL,
                'id' => 90,
                'name' => 'Guatemala',
                'order' => 0,
                'phonecode' => 502,
            ),
            90 => 
            array (
                'code' => 'XU',
                'deleted_at' => NULL,
                'id' => 91,
                'name' => 'Guernsey and Alderney',
                'order' => 0,
                'phonecode' => 44,
            ),
            91 => 
            array (
                'code' => 'GN',
                'deleted_at' => NULL,
                'id' => 92,
                'name' => 'Guinea',
                'order' => 0,
                'phonecode' => 224,
            ),
            92 => 
            array (
                'code' => 'GW',
                'deleted_at' => NULL,
                'id' => 93,
                'name' => 'Guinea-Bissau',
                'order' => 0,
                'phonecode' => 245,
            ),
            93 => 
            array (
                'code' => 'GY',
                'deleted_at' => NULL,
                'id' => 94,
                'name' => 'Guyana',
                'order' => 0,
                'phonecode' => 592,
            ),
            94 => 
            array (
                'code' => 'HT',
                'deleted_at' => NULL,
                'id' => 95,
                'name' => 'Haiti',
                'order' => 0,
                'phonecode' => 509,
            ),
            95 => 
            array (
                'code' => 'HM',
                'deleted_at' => NULL,
                'id' => 96,
                'name' => 'Heard and McDonald Islands',
                'order' => 0,
                'phonecode' => 0,
            ),
            96 => 
            array (
                'code' => 'HN',
                'deleted_at' => NULL,
                'id' => 97,
                'name' => 'Honduras',
                'order' => 0,
                'phonecode' => 504,
            ),
            97 => 
            array (
                'code' => 'HK',
                'deleted_at' => NULL,
                'id' => 98,
                'name' => 'Hong Kong S.A.R.',
                'order' => 0,
                'phonecode' => 852,
            ),
            98 => 
            array (
                'code' => 'HU',
                'deleted_at' => NULL,
                'id' => 99,
                'name' => 'Hungary',
                'order' => 0,
                'phonecode' => 36,
            ),
            99 => 
            array (
                'code' => 'IS',
                'deleted_at' => NULL,
                'id' => 100,
                'name' => 'Iceland',
                'order' => 0,
                'phonecode' => 354,
            ),
            100 => 
            array (
                'code' => 'IN',
                'deleted_at' => NULL,
                'id' => 101,
                'name' => 'India',
                'order' => 0,
                'phonecode' => 91,
            ),
            101 => 
            array (
                'code' => 'ID',
                'deleted_at' => NULL,
                'id' => 102,
                'name' => 'Indonesia',
                'order' => 0,
                'phonecode' => 62,
            ),
            102 => 
            array (
                'code' => 'IR',
                'deleted_at' => NULL,
                'id' => 103,
                'name' => 'Iran',
                'order' => 0,
                'phonecode' => 98,
            ),
            103 => 
            array (
                'code' => 'IQ',
                'deleted_at' => NULL,
                'id' => 104,
                'name' => 'Iraq',
                'order' => 0,
                'phonecode' => 964,
            ),
            104 => 
            array (
                'code' => 'IE',
                'deleted_at' => NULL,
                'id' => 105,
                'name' => 'Ireland',
                'order' => 0,
                'phonecode' => 353,
            ),
            105 => 
            array (
                'code' => 'IL',
                'deleted_at' => NULL,
                'id' => 106,
                'name' => 'Israel',
                'order' => 0,
                'phonecode' => 972,
            ),
            106 => 
            array (
                'code' => 'IT',
                'deleted_at' => NULL,
                'id' => 107,
                'name' => 'Italy',
                'order' => 0,
                'phonecode' => 39,
            ),
            107 => 
            array (
                'code' => 'JM',
                'deleted_at' => NULL,
                'id' => 108,
                'name' => 'Jamaica',
                'order' => 0,
                'phonecode' => 1876,
            ),
            108 => 
            array (
                'code' => 'JP',
                'deleted_at' => NULL,
                'id' => 109,
                'name' => 'Japan',
                'order' => 0,
                'phonecode' => 81,
            ),
            109 => 
            array (
                'code' => 'XJ',
                'deleted_at' => NULL,
                'id' => 110,
                'name' => 'Jersey',
                'order' => 0,
                'phonecode' => 44,
            ),
            110 => 
            array (
                'code' => 'JO',
                'deleted_at' => NULL,
                'id' => 111,
                'name' => 'Jordan',
                'order' => 0,
                'phonecode' => 962,
            ),
            111 => 
            array (
                'code' => 'KZ',
                'deleted_at' => NULL,
                'id' => 112,
                'name' => 'Kazakhstan',
                'order' => 0,
                'phonecode' => 7,
            ),
            112 => 
            array (
                'code' => 'KE',
                'deleted_at' => NULL,
                'id' => 113,
                'name' => 'Kenya',
                'order' => 0,
                'phonecode' => 254,
            ),
            113 => 
            array (
                'code' => 'KI',
                'deleted_at' => NULL,
                'id' => 114,
                'name' => 'Kiribati',
                'order' => 0,
                'phonecode' => 686,
            ),
            114 => 
            array (
                'code' => 'KP',
                'deleted_at' => NULL,
                'id' => 115,
                'name' => 'Korea North',
                'order' => 0,
                'phonecode' => 850,
            ),
            115 => 
            array (
                'code' => 'KR',
                'deleted_at' => NULL,
                'id' => 116,
                'name' => 'Korea South',
                'order' => 0,
                'phonecode' => 82,
            ),
            116 => 
            array (
                'code' => 'KW',
                'deleted_at' => NULL,
                'id' => 117,
                'name' => 'Kuwait',
                'order' => 0,
                'phonecode' => 965,
            ),
            117 => 
            array (
                'code' => 'KG',
                'deleted_at' => NULL,
                'id' => 118,
                'name' => 'Kyrgyzstan',
                'order' => 0,
                'phonecode' => 996,
            ),
            118 => 
            array (
                'code' => 'LA',
                'deleted_at' => NULL,
                'id' => 119,
                'name' => 'Laos',
                'order' => 0,
                'phonecode' => 856,
            ),
            119 => 
            array (
                'code' => 'LV',
                'deleted_at' => NULL,
                'id' => 120,
                'name' => 'Latvia',
                'order' => 0,
                'phonecode' => 371,
            ),
            120 => 
            array (
                'code' => 'LB',
                'deleted_at' => NULL,
                'id' => 121,
                'name' => 'Lebanon',
                'order' => 0,
                'phonecode' => 961,
            ),
            121 => 
            array (
                'code' => 'LS',
                'deleted_at' => NULL,
                'id' => 122,
                'name' => 'Lesotho',
                'order' => 0,
                'phonecode' => 266,
            ),
            122 => 
            array (
                'code' => 'LR',
                'deleted_at' => NULL,
                'id' => 123,
                'name' => 'Liberia',
                'order' => 0,
                'phonecode' => 231,
            ),
            123 => 
            array (
                'code' => 'LY',
                'deleted_at' => NULL,
                'id' => 124,
                'name' => 'Libya',
                'order' => 0,
                'phonecode' => 218,
            ),
            124 => 
            array (
                'code' => 'LI',
                'deleted_at' => NULL,
                'id' => 125,
                'name' => 'Liechtenstein',
                'order' => 0,
                'phonecode' => 423,
            ),
            125 => 
            array (
                'code' => 'LT',
                'deleted_at' => NULL,
                'id' => 126,
                'name' => 'Lithuania',
                'order' => 0,
                'phonecode' => 370,
            ),
            126 => 
            array (
                'code' => 'LU',
                'deleted_at' => NULL,
                'id' => 127,
                'name' => 'Luxembourg',
                'order' => 0,
                'phonecode' => 352,
            ),
            127 => 
            array (
                'code' => 'MO',
                'deleted_at' => NULL,
                'id' => 128,
                'name' => 'Macau S.A.R.',
                'order' => 0,
                'phonecode' => 853,
            ),
            128 => 
            array (
                'code' => 'MK',
                'deleted_at' => NULL,
                'id' => 129,
                'name' => 'Macedonia',
                'order' => 0,
                'phonecode' => 389,
            ),
            129 => 
            array (
                'code' => 'MG',
                'deleted_at' => NULL,
                'id' => 130,
                'name' => 'Madagascar',
                'order' => 0,
                'phonecode' => 261,
            ),
            130 => 
            array (
                'code' => 'MW',
                'deleted_at' => NULL,
                'id' => 131,
                'name' => 'Malawi',
                'order' => 0,
                'phonecode' => 265,
            ),
            131 => 
            array (
                'code' => 'MY',
                'deleted_at' => NULL,
                'id' => 132,
                'name' => 'Malaysia',
                'order' => 0,
                'phonecode' => 60,
            ),
            132 => 
            array (
                'code' => 'MV',
                'deleted_at' => NULL,
                'id' => 133,
                'name' => 'Maldives',
                'order' => 0,
                'phonecode' => 960,
            ),
            133 => 
            array (
                'code' => 'ML',
                'deleted_at' => NULL,
                'id' => 134,
                'name' => 'Mali',
                'order' => 0,
                'phonecode' => 223,
            ),
            134 => 
            array (
                'code' => 'MT',
                'deleted_at' => NULL,
                'id' => 135,
                'name' => 'Malta',
                'order' => 0,
                'phonecode' => 356,
            ),
            135 => 
            array (
                'code' => 'XM',
                'deleted_at' => NULL,
                'id' => 136,
            'name' => 'Man (Isle of)',
                'order' => 0,
                'phonecode' => 44,
            ),
            136 => 
            array (
                'code' => 'MH',
                'deleted_at' => NULL,
                'id' => 137,
                'name' => 'Marshall Islands',
                'order' => 0,
                'phonecode' => 692,
            ),
            137 => 
            array (
                'code' => 'MQ',
                'deleted_at' => NULL,
                'id' => 138,
                'name' => 'Martinique',
                'order' => 0,
                'phonecode' => 596,
            ),
            138 => 
            array (
                'code' => 'MR',
                'deleted_at' => NULL,
                'id' => 139,
                'name' => 'Mauritania',
                'order' => 0,
                'phonecode' => 222,
            ),
            139 => 
            array (
                'code' => 'MU',
                'deleted_at' => NULL,
                'id' => 140,
                'name' => 'Mauritius',
                'order' => 0,
                'phonecode' => 230,
            ),
            140 => 
            array (
                'code' => 'YT',
                'deleted_at' => NULL,
                'id' => 141,
                'name' => 'Mayotte',
                'order' => 0,
                'phonecode' => 269,
            ),
            141 => 
            array (
                'code' => 'MX',
                'deleted_at' => NULL,
                'id' => 142,
                'name' => 'Mexico',
                'order' => 0,
                'phonecode' => 52,
            ),
            142 => 
            array (
                'code' => 'FM',
                'deleted_at' => NULL,
                'id' => 143,
                'name' => 'Micronesia',
                'order' => 0,
                'phonecode' => 691,
            ),
            143 => 
            array (
                'code' => 'MD',
                'deleted_at' => NULL,
                'id' => 144,
                'name' => 'Moldova',
                'order' => 0,
                'phonecode' => 373,
            ),
            144 => 
            array (
                'code' => 'MC',
                'deleted_at' => NULL,
                'id' => 145,
                'name' => 'Monaco',
                'order' => 0,
                'phonecode' => 377,
            ),
            145 => 
            array (
                'code' => 'MN',
                'deleted_at' => NULL,
                'id' => 146,
                'name' => 'Mongolia',
                'order' => 0,
                'phonecode' => 976,
            ),
            146 => 
            array (
                'code' => 'MS',
                'deleted_at' => NULL,
                'id' => 147,
                'name' => 'Montserrat',
                'order' => 0,
                'phonecode' => 1664,
            ),
            147 => 
            array (
                'code' => 'MA',
                'deleted_at' => NULL,
                'id' => 148,
                'name' => 'Morocco',
                'order' => 0,
                'phonecode' => 212,
            ),
            148 => 
            array (
                'code' => 'MZ',
                'deleted_at' => NULL,
                'id' => 149,
                'name' => 'Mozambique',
                'order' => 0,
                'phonecode' => 258,
            ),
            149 => 
            array (
                'code' => 'MM',
                'deleted_at' => NULL,
                'id' => 150,
                'name' => 'Myanmar',
                'order' => 0,
                'phonecode' => 95,
            ),
            150 => 
            array (
                'code' => 'NA',
                'deleted_at' => NULL,
                'id' => 151,
                'name' => 'Namibia',
                'order' => 0,
                'phonecode' => 264,
            ),
            151 => 
            array (
                'code' => 'NR',
                'deleted_at' => NULL,
                'id' => 152,
                'name' => 'Nauru',
                'order' => 0,
                'phonecode' => 674,
            ),
            152 => 
            array (
                'code' => 'NP',
                'deleted_at' => NULL,
                'id' => 153,
                'name' => 'Nepal',
                'order' => 0,
                'phonecode' => 977,
            ),
            153 => 
            array (
                'code' => 'AN',
                'deleted_at' => NULL,
                'id' => 154,
                'name' => 'Netherlands Antilles',
                'order' => 0,
                'phonecode' => 599,
            ),
            154 => 
            array (
                'code' => 'NL',
                'deleted_at' => NULL,
                'id' => 155,
                'name' => 'Netherlands The',
                'order' => 0,
                'phonecode' => 31,
            ),
            155 => 
            array (
                'code' => 'NC',
                'deleted_at' => NULL,
                'id' => 156,
                'name' => 'New Caledonia',
                'order' => 0,
                'phonecode' => 687,
            ),
            156 => 
            array (
                'code' => 'NZ',
                'deleted_at' => NULL,
                'id' => 157,
                'name' => 'New Zealand',
                'order' => 0,
                'phonecode' => 64,
            ),
            157 => 
            array (
                'code' => 'NI',
                'deleted_at' => NULL,
                'id' => 158,
                'name' => 'Nicaragua',
                'order' => 0,
                'phonecode' => 505,
            ),
            158 => 
            array (
                'code' => 'NE',
                'deleted_at' => NULL,
                'id' => 159,
                'name' => 'Niger',
                'order' => 0,
                'phonecode' => 227,
            ),
            159 => 
            array (
                'code' => 'NG',
                'deleted_at' => NULL,
                'id' => 160,
                'name' => 'Nigeria',
                'order' => 0,
                'phonecode' => 234,
            ),
            160 => 
            array (
                'code' => 'NU',
                'deleted_at' => NULL,
                'id' => 161,
                'name' => 'Niue',
                'order' => 0,
                'phonecode' => 683,
            ),
            161 => 
            array (
                'code' => 'NF',
                'deleted_at' => NULL,
                'id' => 162,
                'name' => 'Norfolk Island',
                'order' => 0,
                'phonecode' => 672,
            ),
            162 => 
            array (
                'code' => 'MP',
                'deleted_at' => NULL,
                'id' => 163,
                'name' => 'Northern Mariana Islands',
                'order' => 0,
                'phonecode' => 1670,
            ),
            163 => 
            array (
                'code' => 'NO',
                'deleted_at' => NULL,
                'id' => 164,
                'name' => 'Norway',
                'order' => 0,
                'phonecode' => 47,
            ),
            164 => 
            array (
                'code' => 'OM',
                'deleted_at' => NULL,
                'id' => 165,
                'name' => 'Oman',
                'order' => 0,
                'phonecode' => 968,
            ),
            165 => 
            array (
                'code' => 'PK',
                'deleted_at' => NULL,
                'id' => 166,
                'name' => 'Pakistan',
                'order' => 0,
                'phonecode' => 92,
            ),
            166 => 
            array (
                'code' => 'PW',
                'deleted_at' => NULL,
                'id' => 167,
                'name' => 'Palau',
                'order' => 0,
                'phonecode' => 680,
            ),
            167 => 
            array (
                'code' => 'PS',
                'deleted_at' => NULL,
                'id' => 168,
                'name' => 'Palestinian Territory Occupied',
                'order' => 0,
                'phonecode' => 970,
            ),
            168 => 
            array (
                'code' => 'PA',
                'deleted_at' => NULL,
                'id' => 169,
                'name' => 'Panama',
                'order' => 0,
                'phonecode' => 507,
            ),
            169 => 
            array (
                'code' => 'PG',
                'deleted_at' => NULL,
                'id' => 170,
                'name' => 'Papua new Guinea',
                'order' => 0,
                'phonecode' => 675,
            ),
            170 => 
            array (
                'code' => 'PY',
                'deleted_at' => NULL,
                'id' => 171,
                'name' => 'Paraguay',
                'order' => 0,
                'phonecode' => 595,
            ),
            171 => 
            array (
                'code' => 'PE',
                'deleted_at' => NULL,
                'id' => 172,
                'name' => 'Peru',
                'order' => 0,
                'phonecode' => 51,
            ),
            172 => 
            array (
                'code' => 'PH',
                'deleted_at' => NULL,
                'id' => 173,
                'name' => 'Philippines',
                'order' => 0,
                'phonecode' => 63,
            ),
            173 => 
            array (
                'code' => 'PN',
                'deleted_at' => NULL,
                'id' => 174,
                'name' => 'Pitcairn Island',
                'order' => 0,
                'phonecode' => 0,
            ),
            174 => 
            array (
                'code' => 'PL',
                'deleted_at' => NULL,
                'id' => 175,
                'name' => 'Poland',
                'order' => 0,
                'phonecode' => 48,
            ),
            175 => 
            array (
                'code' => 'PT',
                'deleted_at' => NULL,
                'id' => 176,
                'name' => 'Portugal',
                'order' => 0,
                'phonecode' => 351,
            ),
            176 => 
            array (
                'code' => 'PR',
                'deleted_at' => NULL,
                'id' => 177,
                'name' => 'Puerto Rico',
                'order' => 0,
                'phonecode' => 1787,
            ),
            177 => 
            array (
                'code' => 'QA',
                'deleted_at' => NULL,
                'id' => 178,
                'name' => 'Qatar',
                'order' => 0,
                'phonecode' => 974,
            ),
            178 => 
            array (
                'code' => 'RE',
                'deleted_at' => NULL,
                'id' => 179,
                'name' => 'Reunion',
                'order' => 0,
                'phonecode' => 262,
            ),
            179 => 
            array (
                'code' => 'RO',
                'deleted_at' => NULL,
                'id' => 180,
                'name' => 'Romania',
                'order' => 0,
                'phonecode' => 40,
            ),
            180 => 
            array (
                'code' => 'RU',
                'deleted_at' => NULL,
                'id' => 181,
                'name' => 'Russia',
                'order' => 0,
                'phonecode' => 70,
            ),
            181 => 
            array (
                'code' => 'RW',
                'deleted_at' => NULL,
                'id' => 182,
                'name' => 'Rwanda',
                'order' => 0,
                'phonecode' => 250,
            ),
            182 => 
            array (
                'code' => 'SH',
                'deleted_at' => NULL,
                'id' => 183,
                'name' => 'Saint Helena',
                'order' => 0,
                'phonecode' => 290,
            ),
            183 => 
            array (
                'code' => 'KN',
                'deleted_at' => NULL,
                'id' => 184,
                'name' => 'Saint Kitts And Nevis',
                'order' => 0,
                'phonecode' => 1869,
            ),
            184 => 
            array (
                'code' => 'LC',
                'deleted_at' => NULL,
                'id' => 185,
                'name' => 'Saint Lucia',
                'order' => 0,
                'phonecode' => 1758,
            ),
            185 => 
            array (
                'code' => 'PM',
                'deleted_at' => NULL,
                'id' => 186,
                'name' => 'Saint Pierre and Miquelon',
                'order' => 0,
                'phonecode' => 508,
            ),
            186 => 
            array (
                'code' => 'VC',
                'deleted_at' => NULL,
                'id' => 187,
                'name' => 'Saint Vincent And The Grenadines',
                'order' => 0,
                'phonecode' => 1784,
            ),
            187 => 
            array (
                'code' => 'WS',
                'deleted_at' => NULL,
                'id' => 188,
                'name' => 'Samoa',
                'order' => 0,
                'phonecode' => 684,
            ),
            188 => 
            array (
                'code' => 'SM',
                'deleted_at' => NULL,
                'id' => 189,
                'name' => 'San Marino',
                'order' => 0,
                'phonecode' => 378,
            ),
            189 => 
            array (
                'code' => 'ST',
                'deleted_at' => NULL,
                'id' => 190,
                'name' => 'Sao Tome and Principe',
                'order' => 0,
                'phonecode' => 239,
            ),
            190 => 
            array (
                'code' => 'SA',
                'deleted_at' => NULL,
                'id' => 191,
                'name' => 'Saudi Arabia',
                'order' => 0,
                'phonecode' => 966,
            ),
            191 => 
            array (
                'code' => 'SN',
                'deleted_at' => NULL,
                'id' => 192,
                'name' => 'Senegal',
                'order' => 0,
                'phonecode' => 221,
            ),
            192 => 
            array (
                'code' => 'RS',
                'deleted_at' => NULL,
                'id' => 193,
                'name' => 'Serbia',
                'order' => 0,
                'phonecode' => 381,
            ),
            193 => 
            array (
                'code' => 'SC',
                'deleted_at' => NULL,
                'id' => 194,
                'name' => 'Seychelles',
                'order' => 0,
                'phonecode' => 248,
            ),
            194 => 
            array (
                'code' => 'SL',
                'deleted_at' => NULL,
                'id' => 195,
                'name' => 'Sierra Leone',
                'order' => 0,
                'phonecode' => 232,
            ),
            195 => 
            array (
                'code' => 'SG',
                'deleted_at' => NULL,
                'id' => 196,
                'name' => 'Singapore',
                'order' => 0,
                'phonecode' => 65,
            ),
            196 => 
            array (
                'code' => 'SK',
                'deleted_at' => NULL,
                'id' => 197,
                'name' => 'Slovakia',
                'order' => 0,
                'phonecode' => 421,
            ),
            197 => 
            array (
                'code' => 'SI',
                'deleted_at' => NULL,
                'id' => 198,
                'name' => 'Slovenia',
                'order' => 0,
                'phonecode' => 386,
            ),
            198 => 
            array (
                'code' => 'XG',
                'deleted_at' => NULL,
                'id' => 199,
                'name' => 'Smaller Territories of the UK',
                'order' => 0,
                'phonecode' => 44,
            ),
            199 => 
            array (
                'code' => 'SB',
                'deleted_at' => NULL,
                'id' => 200,
                'name' => 'Solomon Islands',
                'order' => 0,
                'phonecode' => 677,
            ),
            200 => 
            array (
                'code' => 'SO',
                'deleted_at' => NULL,
                'id' => 201,
                'name' => 'Somalia',
                'order' => 0,
                'phonecode' => 252,
            ),
            201 => 
            array (
                'code' => 'ZA',
                'deleted_at' => NULL,
                'id' => 202,
                'name' => 'South Africa',
                'order' => 0,
                'phonecode' => 27,
            ),
            202 => 
            array (
                'code' => 'GS',
                'deleted_at' => NULL,
                'id' => 203,
                'name' => 'South Georgia',
                'order' => 0,
                'phonecode' => 0,
            ),
            203 => 
            array (
                'code' => 'SS',
                'deleted_at' => NULL,
                'id' => 204,
                'name' => 'South Sudan',
                'order' => 0,
                'phonecode' => 211,
            ),
            204 => 
            array (
                'code' => 'ES',
                'deleted_at' => NULL,
                'id' => 205,
                'name' => 'Spain',
                'order' => 0,
                'phonecode' => 34,
            ),
            205 => 
            array (
                'code' => 'LK',
                'deleted_at' => NULL,
                'id' => 206,
                'name' => 'Sri Lanka',
                'order' => 0,
                'phonecode' => 94,
            ),
            206 => 
            array (
                'code' => 'SD',
                'deleted_at' => NULL,
                'id' => 207,
                'name' => 'Sudan',
                'order' => 0,
                'phonecode' => 249,
            ),
            207 => 
            array (
                'code' => 'SR',
                'deleted_at' => NULL,
                'id' => 208,
                'name' => 'Suriname',
                'order' => 0,
                'phonecode' => 597,
            ),
            208 => 
            array (
                'code' => 'SJ',
                'deleted_at' => NULL,
                'id' => 209,
                'name' => 'Svalbard And Jan Mayen Islands',
                'order' => 0,
                'phonecode' => 47,
            ),
            209 => 
            array (
                'code' => 'SZ',
                'deleted_at' => NULL,
                'id' => 210,
                'name' => 'Swaziland',
                'order' => 0,
                'phonecode' => 268,
            ),
            210 => 
            array (
                'code' => 'SE',
                'deleted_at' => NULL,
                'id' => 211,
                'name' => 'Sweden',
                'order' => 0,
                'phonecode' => 46,
            ),
            211 => 
            array (
                'code' => 'CH',
                'deleted_at' => NULL,
                'id' => 212,
                'name' => 'Switzerland',
                'order' => 0,
                'phonecode' => 41,
            ),
            212 => 
            array (
                'code' => 'SY',
                'deleted_at' => NULL,
                'id' => 213,
                'name' => 'Syria',
                'order' => 0,
                'phonecode' => 963,
            ),
            213 => 
            array (
                'code' => 'TW',
                'deleted_at' => NULL,
                'id' => 214,
                'name' => 'Taiwan',
                'order' => 0,
                'phonecode' => 886,
            ),
            214 => 
            array (
                'code' => 'TJ',
                'deleted_at' => NULL,
                'id' => 215,
                'name' => 'Tajikistan',
                'order' => 0,
                'phonecode' => 992,
            ),
            215 => 
            array (
                'code' => 'TZ',
                'deleted_at' => NULL,
                'id' => 216,
                'name' => 'Tanzania',
                'order' => 0,
                'phonecode' => 255,
            ),
            216 => 
            array (
                'code' => 'TH',
                'deleted_at' => NULL,
                'id' => 217,
                'name' => 'Thailand',
                'order' => 0,
                'phonecode' => 66,
            ),
            217 => 
            array (
                'code' => 'TG',
                'deleted_at' => NULL,
                'id' => 218,
                'name' => 'Togo',
                'order' => 0,
                'phonecode' => 228,
            ),
            218 => 
            array (
                'code' => 'TK',
                'deleted_at' => NULL,
                'id' => 219,
                'name' => 'Tokelau',
                'order' => 0,
                'phonecode' => 690,
            ),
            219 => 
            array (
                'code' => 'TO',
                'deleted_at' => NULL,
                'id' => 220,
                'name' => 'Tonga',
                'order' => 0,
                'phonecode' => 676,
            ),
            220 => 
            array (
                'code' => 'TT',
                'deleted_at' => NULL,
                'id' => 221,
                'name' => 'Trinidad And Tobago',
                'order' => 0,
                'phonecode' => 1868,
            ),
            221 => 
            array (
                'code' => 'TN',
                'deleted_at' => NULL,
                'id' => 222,
                'name' => 'Tunisia',
                'order' => 0,
                'phonecode' => 216,
            ),
            222 => 
            array (
                'code' => 'TR',
                'deleted_at' => NULL,
                'id' => 223,
                'name' => 'Turkey',
                'order' => 0,
                'phonecode' => 90,
            ),
            223 => 
            array (
                'code' => 'TM',
                'deleted_at' => NULL,
                'id' => 224,
                'name' => 'Turkmenistan',
                'order' => 0,
                'phonecode' => 7370,
            ),
            224 => 
            array (
                'code' => 'TC',
                'deleted_at' => NULL,
                'id' => 225,
                'name' => 'Turks And Caicos Islands',
                'order' => 0,
                'phonecode' => 1649,
            ),
            225 => 
            array (
                'code' => 'TV',
                'deleted_at' => NULL,
                'id' => 226,
                'name' => 'Tuvalu',
                'order' => 0,
                'phonecode' => 688,
            ),
            226 => 
            array (
                'code' => 'UG',
                'deleted_at' => NULL,
                'id' => 227,
                'name' => 'Uganda',
                'order' => 0,
                'phonecode' => 256,
            ),
            227 => 
            array (
                'code' => 'UA',
                'deleted_at' => NULL,
                'id' => 228,
                'name' => 'Ukraine',
                'order' => 0,
                'phonecode' => 380,
            ),
            228 => 
            array (
                'code' => 'AE',
                'deleted_at' => NULL,
                'id' => 229,
                'name' => 'United Arab Emirates',
                'order' => 0,
                'phonecode' => 971,
            ),
            229 => 
            array (
                'code' => 'GB',
                'deleted_at' => NULL,
                'id' => 230,
                'name' => 'United Kingdom',
                'order' => 0,
                'phonecode' => 44,
            ),
            230 => 
            array (
                'code' => 'US',
                'deleted_at' => NULL,
                'id' => 231,
                'name' => 'United States',
                'order' => 0,
                'phonecode' => 1,
            ),
            231 => 
            array (
                'code' => 'UM',
                'deleted_at' => NULL,
                'id' => 232,
                'name' => 'United States Minor Outlying Islands',
                'order' => 0,
                'phonecode' => 1,
            ),
            232 => 
            array (
                'code' => 'UY',
                'deleted_at' => NULL,
                'id' => 233,
                'name' => 'Uruguay',
                'order' => 0,
                'phonecode' => 598,
            ),
            233 => 
            array (
                'code' => 'UZ',
                'deleted_at' => NULL,
                'id' => 234,
                'name' => 'Uzbekistan',
                'order' => 0,
                'phonecode' => 998,
            ),
            234 => 
            array (
                'code' => 'VU',
                'deleted_at' => NULL,
                'id' => 235,
                'name' => 'Vanuatu',
                'order' => 0,
                'phonecode' => 678,
            ),
            235 => 
            array (
                'code' => 'VA',
                'deleted_at' => NULL,
                'id' => 236,
            'name' => 'Vatican City State (Holy See)',
                'order' => 0,
                'phonecode' => 39,
            ),
            236 => 
            array (
                'code' => 'VE',
                'deleted_at' => NULL,
                'id' => 237,
                'name' => 'Venezuela',
                'order' => 0,
                'phonecode' => 58,
            ),
            237 => 
            array (
                'code' => 'VN',
                'deleted_at' => NULL,
                'id' => 238,
                'name' => 'Vietnam',
                'order' => 0,
                'phonecode' => 84,
            ),
            238 => 
            array (
                'code' => 'VG',
                'deleted_at' => NULL,
                'id' => 239,
            'name' => 'Virgin Islands (British)',
                'order' => 0,
                'phonecode' => 1284,
            ),
            239 => 
            array (
                'code' => 'VI',
                'deleted_at' => NULL,
                'id' => 240,
            'name' => 'Virgin Islands (US)',
                'order' => 0,
                'phonecode' => 1340,
            ),
            240 => 
            array (
                'code' => 'WF',
                'deleted_at' => NULL,
                'id' => 241,
                'name' => 'Wallis And Futuna Islands',
                'order' => 0,
                'phonecode' => 681,
            ),
            241 => 
            array (
                'code' => 'EH',
                'deleted_at' => NULL,
                'id' => 242,
                'name' => 'Western Sahara',
                'order' => 0,
                'phonecode' => 212,
            ),
            242 => 
            array (
                'code' => 'YE',
                'deleted_at' => NULL,
                'id' => 243,
                'name' => 'Yemen',
                'order' => 0,
                'phonecode' => 967,
            ),
            243 => 
            array (
                'code' => 'YU',
                'deleted_at' => NULL,
                'id' => 244,
                'name' => 'Yugoslavia',
                'order' => 0,
                'phonecode' => 38,
            ),
            244 => 
            array (
                'code' => 'ZM',
                'deleted_at' => NULL,
                'id' => 245,
                'name' => 'Zambia',
                'order' => 0,
                'phonecode' => 260,
            ),
            245 => 
            array (
                'code' => 'ZW',
                'deleted_at' => NULL,
                'id' => 246,
                'name' => 'Zimbabwe',
                'order' => 0,
                'phonecode' => 263,
            ),
        ));
        
        
    }
}