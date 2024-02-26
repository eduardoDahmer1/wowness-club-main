<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->char('code', 2);
            $table->string('name');
        });

        $this->insertCountries();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }

    private function insertCountries(): void
    {
        DB::table('countries')->insert([
            0 =>
            [
                'id' => 1,
                'code' => 'AF',
                'name' => 'Afghanistan',
            ],
            1 =>
            [
                'id' => 2,
                'code' => 'AL',
                'name' => 'Albania',
            ],
            2 =>
            [
                'id' => 3,
                'code' => 'DZ',
                'name' => 'Algeria',
            ],
            3 =>
            [
                'id' => 4,
                'code' => 'DS',
                'name' => 'American Samoa',
            ],
            4 =>
            [
                'id' => 5,
                'code' => 'AD',
                'name' => 'Andorra',
            ],
            5 =>
            [
                'id' => 6,
                'code' => 'AO',
                'name' => 'Angola',
            ],
            6 =>
            [
                'id' => 7,
                'code' => 'AI',
                'name' => 'Anguilla',
            ],
            7 =>
            [
                'id' => 8,
                'code' => 'AQ',
                'name' => 'Antarctica',
            ],
            8 =>
            [
                'id' => 9,
                'code' => 'AG',
                'name' => 'Antigua and Barbuda',
            ],
            9 =>
            [
                'id' => 10,
                'code' => 'AR',
                'name' => 'Argentina',
            ],
            10 =>
            [
                'id' => 11,
                'code' => 'AM',
                'name' => 'Armenia',
            ],
            11 =>
            [
                'id' => 12,
                'code' => 'AW',
                'name' => 'Aruba',
            ],
            12 =>
            [
                'id' => 13,
                'code' => 'AU',
                'name' => 'Australia',
            ],
            13 =>
            [
                'id' => 14,
                'code' => 'AT',
                'name' => 'Austria',
            ],
            14 =>
            [
                'id' => 15,
                'code' => 'AZ',
                'name' => 'Azerbaijan',
            ],
            15 =>
            [
                'id' => 16,
                'code' => 'BS',
                'name' => 'Bahamas',
            ],
            16 =>
            [
                'id' => 17,
                'code' => 'BH',
                'name' => 'Bahrain',
            ],
            17 =>
            [
                'id' => 18,
                'code' => 'BD',
                'name' => 'Bangladesh',
            ],
            18 =>
            [
                'id' => 19,
                'code' => 'BB',
                'name' => 'Barbados',
            ],
            19 =>
            [
                'id' => 20,
                'code' => 'BY',
                'name' => 'Belarus',
            ],
            20 =>
            [
                'id' => 21,
                'code' => 'BE',
                'name' => 'Belgium',
            ],
            21 =>
            [
                'id' => 22,
                'code' => 'BZ',
                'name' => 'Belize',
            ],
            22 =>
            [
                'id' => 23,
                'code' => 'BJ',
                'name' => 'Benin',
            ],
            23 =>
            [
                'id' => 24,
                'code' => 'BM',
                'name' => 'Bermuda',
            ],
            24 =>
            [
                'id' => 25,
                'code' => 'BT',
                'name' => 'Bhutan',
            ],
            25 =>
            [
                'id' => 26,
                'code' => 'BO',
                'name' => 'Bolivia',
            ],
            26 =>
            [
                'id' => 27,
                'code' => 'BA',
                'name' => 'Bosnia and Herzegovina',
            ],
            27 =>
            [
                'id' => 28,
                'code' => 'BW',
                'name' => 'Botswana',
            ],
            28 =>
            [
                'id' => 29,
                'code' => 'BV',
                'name' => 'Bouvet Island',
            ],
            29 =>
            [
                'id' => 30,
                'code' => 'BR',
                'name' => 'Brazil',
            ],
            30 =>
            [
                'id' => 31,
                'code' => 'IO',
                'name' => 'British Indian Ocean Territory',
            ],
            31 =>
            [
                'id' => 32,
                'code' => 'BN',
                'name' => 'Brunei Darussalam',
            ],
            32 =>
            [
                'id' => 33,
                'code' => 'BG',
                'name' => 'Bulgaria',
            ],
            33 =>
            [
                'id' => 34,
                'code' => 'BF',
                'name' => 'Burkina Faso',
            ],
            34 =>
            [
                'id' => 35,
                'code' => 'BI',
                'name' => 'Burundi',
            ],
            35 =>
            [
                'id' => 36,
                'code' => 'KH',
                'name' => 'Cambodia',
            ],
            36 =>
            [
                'id' => 37,
                'code' => 'CM',
                'name' => 'Cameroon',
            ],
            37 =>
            [
                'id' => 38,
                'code' => 'CA',
                'name' => 'Canada',
            ],
            38 =>
            [
                'id' => 39,
                'code' => 'CV',
                'name' => 'Cape Verde',
            ],
            39 =>
            [
                'id' => 40,
                'code' => 'KY',
                'name' => 'Cayman Islands',
            ],
            40 =>
            [
                'id' => 41,
                'code' => 'CF',
                'name' => 'Central African Republic',
            ],
            41 =>
            [
                'id' => 42,
                'code' => 'TD',
                'name' => 'Chad',
            ],
            42 =>
            [
                'id' => 43,
                'code' => 'CL',
                'name' => 'Chile',
            ],
            43 =>
            [
                'id' => 44,
                'code' => 'CN',
                'name' => 'China',
            ],
            44 =>
            [
                'id' => 45,
                'code' => 'CX',
                'name' => 'Christmas Island',
            ],
            45 =>
            [
                'id' => 46,
                'code' => 'CC',
            'name' => 'Cocos (Keeling) Islands',
            ],
            46 =>
            [
                'id' => 47,
                'code' => 'CO',
                'name' => 'Colombia',
            ],
            47 =>
            [
                'id' => 48,
                'code' => 'KM',
                'name' => 'Comoros',
            ],
            48 =>
            [
                'id' => 49,
                'code' => 'CD',
                'name' => 'Democratic Republic of the Congo',
            ],
            49 =>
            [
                'id' => 50,
                'code' => 'CG',
                'name' => 'Republic of Congo',
            ],
            50 =>
            [
                'id' => 51,
                'code' => 'CK',
                'name' => 'Cook Islands',
            ],
            51 =>
            [
                'id' => 52,
                'code' => 'CR',
                'name' => 'Costa Rica',
            ],
            52 =>
            [
                'id' => 53,
                'code' => 'HR',
            'name' => 'Croatia (Hrvatska)',
            ],
            53 =>
            [
                'id' => 54,
                'code' => 'CU',
                'name' => 'Cuba',
            ],
            54 =>
            [
                'id' => 55,
                'code' => 'CY',
                'name' => 'Cyprus',
            ],
            55 =>
            [
                'id' => 56,
                'code' => 'CZ',
                'name' => 'Czech Republic',
            ],
            56 =>
            [
                'id' => 57,
                'code' => 'DK',
                'name' => 'Denmark',
            ],
            57 =>
            [
                'id' => 58,
                'code' => 'DJ',
                'name' => 'Djibouti',
            ],
            58 =>
            [
                'id' => 59,
                'code' => 'DM',
                'name' => 'Dominica',
            ],
            59 =>
            [
                'id' => 60,
                'code' => 'DO',
                'name' => 'Dominican Republic',
            ],
            60 =>
            [
                'id' => 61,
                'code' => 'TP',
                'name' => 'East Timor',
            ],
            61 =>
            [
                'id' => 62,
                'code' => 'EC',
                'name' => 'Ecuador',
            ],
            62 =>
            [
                'id' => 63,
                'code' => 'EG',
                'name' => 'Egypt',
            ],
            63 =>
            [
                'id' => 64,
                'code' => 'SV',
                'name' => 'El Salvador',
            ],
            64 =>
            [
                'id' => 65,
                'code' => 'GQ',
                'name' => 'Equatorial Guinea',
            ],
            65 =>
            [
                'id' => 66,
                'code' => 'ER',
                'name' => 'Eritrea',
            ],
            66 =>
            [
                'id' => 67,
                'code' => 'EE',
                'name' => 'Estonia',
            ],
            67 =>
            [
                'id' => 68,
                'code' => 'ET',
                'name' => 'Ethiopia',
            ],
            68 =>
            [
                'id' => 69,
                'code' => 'FK',
            'name' => 'Falkland Islands (Malvinas)',
            ],
            69 =>
            [
                'id' => 70,
                'code' => 'FO',
                'name' => 'Faroe Islands',
            ],
            70 =>
            [
                'id' => 71,
                'code' => 'FJ',
                'name' => 'Fiji',
            ],
            71 =>
            [
                'id' => 72,
                'code' => 'FI',
                'name' => 'Finland',
            ],
            72 =>
            [
                'id' => 73,
                'code' => 'FR',
                'name' => 'France',
            ],
            73 =>
            [
                'id' => 74,
                'code' => 'FX',
                'name' => 'France, Metropolitan',
            ],
            74 =>
            [
                'id' => 75,
                'code' => 'GF',
                'name' => 'French Guiana',
            ],
            75 =>
            [
                'id' => 76,
                'code' => 'PF',
                'name' => 'French Polynesia',
            ],
            76 =>
            [
                'id' => 77,
                'code' => 'TF',
                'name' => 'French Southern Territories',
            ],
            77 =>
            [
                'id' => 78,
                'code' => 'GA',
                'name' => 'Gabon',
            ],
            78 =>
            [
                'id' => 79,
                'code' => 'GM',
                'name' => 'Gambia',
            ],
            79 =>
            [
                'id' => 80,
                'code' => 'GE',
                'name' => 'Georgia',
            ],
            80 =>
            [
                'id' => 81,
                'code' => 'DE',
                'name' => 'Germany',
            ],
            81 =>
            [
                'id' => 82,
                'code' => 'GH',
                'name' => 'Ghana',
            ],
            82 =>
            [
                'id' => 83,
                'code' => 'GI',
                'name' => 'Gibraltar',
            ],
            83 =>
            [
                'id' => 84,
                'code' => 'GK',
                'name' => 'Guernsey',
            ],
            84 =>
            [
                'id' => 85,
                'code' => 'GR',
                'name' => 'Greece',
            ],
            85 =>
            [
                'id' => 86,
                'code' => 'GL',
                'name' => 'Greenland',
            ],
            86 =>
            [
                'id' => 87,
                'code' => 'GD',
                'name' => 'Grenada',
            ],
            87 =>
            [
                'id' => 88,
                'code' => 'GP',
                'name' => 'Guadeloupe',
            ],
            88 =>
            [
                'id' => 89,
                'code' => 'GU',
                'name' => 'Guam',
            ],
            89 =>
            [
                'id' => 90,
                'code' => 'GT',
                'name' => 'Guatemala',
            ],
            90 =>
            [
                'id' => 91,
                'code' => 'GN',
                'name' => 'Guinea',
            ],
            91 =>
            [
                'id' => 92,
                'code' => 'GW',
                'name' => 'Guinea-Bissau',
            ],
            92 =>
            [
                'id' => 93,
                'code' => 'GY',
                'name' => 'Guyana',
            ],
            93 =>
            [
                'id' => 94,
                'code' => 'HT',
                'name' => 'Haiti',
            ],
            94 =>
            [
                'id' => 95,
                'code' => 'HM',
                'name' => 'Heard and Mc Donald Islands',
            ],
            95 =>
            [
                'id' => 96,
                'code' => 'HN',
                'name' => 'Honduras',
            ],
            96 =>
            [
                'id' => 97,
                'code' => 'HK',
                'name' => 'Hong Kong',
            ],
            97 =>
            [
                'id' => 98,
                'code' => 'HU',
                'name' => 'Hungary',
            ],
            98 =>
            [
                'id' => 99,
                'code' => 'IS',
                'name' => 'Iceland',
            ],
            99 =>
            [
                'id' => 100,
                'code' => 'IN',
                'name' => 'India',
            ],
            100 =>
            [
                'id' => 101,
                'code' => 'IM',
                'name' => 'Isle of Man',
            ],
            101 =>
            [
                'id' => 102,
                'code' => 'ID',
                'name' => 'Indonesia',
            ],
            102 =>
            [
                'id' => 103,
                'code' => 'IR',
            'name' => 'Iran (Islamic Republic of)',
            ],
            103 =>
            [
                'id' => 104,
                'code' => 'IQ',
                'name' => 'Iraq',
            ],
            104 =>
            [
                'id' => 105,
                'code' => 'IE',
                'name' => 'Ireland',
            ],
            105 =>
            [
                'id' => 106,
                'code' => 'IL',
                'name' => 'Israel',
            ],
            106 =>
            [
                'id' => 107,
                'code' => 'IT',
                'name' => 'Italy',
            ],
            107 =>
            [
                'id' => 108,
                'code' => 'CI',
                'name' => 'Ivory Coast',
            ],
            108 =>
            [
                'id' => 109,
                'code' => 'JE',
                'name' => 'Jersey',
            ],
            109 =>
            [
                'id' => 110,
                'code' => 'JM',
                'name' => 'Jamaica',
            ],
            110 =>
            [
                'id' => 111,
                'code' => 'JP',
                'name' => 'Japan',
            ],
            111 =>
            [
                'id' => 112,
                'code' => 'JO',
                'name' => 'Jordan',
            ],
            112 =>
            [
                'id' => 113,
                'code' => 'KZ',
                'name' => 'Kazakhstan',
            ],
            113 =>
            [
                'id' => 114,
                'code' => 'KE',
                'name' => 'Kenya',
            ],
            114 =>
            [
                'id' => 115,
                'code' => 'KI',
                'name' => 'Kiribati',
            ],
            115 =>
            [
                'id' => 116,
                'code' => 'KP',
                'name' => 'Korea, Democratic People\'s Republic of',
            ],
            116 =>
            [
                'id' => 117,
                'code' => 'KR',
                'name' => 'Korea, Republic of',
            ],
            117 =>
            [
                'id' => 118,
                'code' => 'XK',
                'name' => 'Kosovo',
            ],
            118 =>
            [
                'id' => 119,
                'code' => 'KW',
                'name' => 'Kuwait',
            ],
            119 =>
            [
                'id' => 120,
                'code' => 'KG',
                'name' => 'Kyrgyzstan',
            ],
            120 =>
            [
                'id' => 121,
                'code' => 'LA',
                'name' => 'Lao People\'s Democratic Republic',
            ],
            121 =>
            [
                'id' => 122,
                'code' => 'LV',
                'name' => 'Latvia',
            ],
            122 =>
            [
                'id' => 123,
                'code' => 'LB',
                'name' => 'Lebanon',
            ],
            123 =>
            [
                'id' => 124,
                'code' => 'LS',
                'name' => 'Lesotho',
            ],
            124 =>
            [
                'id' => 125,
                'code' => 'LR',
                'name' => 'Liberia',
            ],
            125 =>
            [
                'id' => 126,
                'code' => 'LY',
                'name' => 'Libyan Arab Jamahiriya',
            ],
            126 =>
            [
                'id' => 127,
                'code' => 'LI',
                'name' => 'Liechtenstein',
            ],
            127 =>
            [
                'id' => 128,
                'code' => 'LT',
                'name' => 'Lithuania',
            ],
            128 =>
            [
                'id' => 129,
                'code' => 'LU',
                'name' => 'Luxembourg',
            ],
            129 =>
            [
                'id' => 130,
                'code' => 'MO',
                'name' => 'Macau',
            ],
            130 =>
            [
                'id' => 131,
                'code' => 'MK',
                'name' => 'North Macedonia',
            ],
            131 =>
            [
                'id' => 132,
                'code' => 'MG',
                'name' => 'Madagascar',
            ],
            132 =>
            [
                'id' => 133,
                'code' => 'MW',
                'name' => 'Malawi',
            ],
            133 =>
            [
                'id' => 134,
                'code' => 'MY',
                'name' => 'Malaysia',
            ],
            134 =>
            [
                'id' => 135,
                'code' => 'MV',
                'name' => 'Maldives',
            ],
            135 =>
            [
                'id' => 136,
                'code' => 'ML',
                'name' => 'Mali',
            ],
            136 =>
            [
                'id' => 137,
                'code' => 'MT',
                'name' => 'Malta',
            ],
            137 =>
            [
                'id' => 138,
                'code' => 'MH',
                'name' => 'Marshall Islands',
            ],
            138 =>
            [
                'id' => 139,
                'code' => 'MQ',
                'name' => 'Martinique',
            ],
            139 =>
            [
                'id' => 140,
                'code' => 'MR',
                'name' => 'Mauritania',
            ],
            140 =>
            [
                'id' => 141,
                'code' => 'MU',
                'name' => 'Mauritius',
            ],
            141 =>
            [
                'id' => 142,
                'code' => 'TY',
                'name' => 'Mayotte',
            ],
            142 =>
            [
                'id' => 143,
                'code' => 'MX',
                'name' => 'Mexico',
            ],
            143 =>
            [
                'id' => 144,
                'code' => 'FM',
                'name' => 'Micronesia, Federated States of',
            ],
            144 =>
            [
                'id' => 145,
                'code' => 'MD',
                'name' => 'Moldova, Republic of',
            ],
            145 =>
            [
                'id' => 146,
                'code' => 'MC',
                'name' => 'Monaco',
            ],
            146 =>
            [
                'id' => 147,
                'code' => 'MN',
                'name' => 'Mongolia',
            ],
            147 =>
            [
                'id' => 148,
                'code' => 'ME',
                'name' => 'Montenegro',
            ],
            148 =>
            [
                'id' => 149,
                'code' => 'MS',
                'name' => 'Montserrat',
            ],
            149 =>
            [
                'id' => 150,
                'code' => 'MA',
                'name' => 'Morocco',
            ],
            150 =>
            [
                'id' => 151,
                'code' => 'MZ',
                'name' => 'Mozambique',
            ],
            151 =>
            [
                'id' => 152,
                'code' => 'MM',
                'name' => 'Myanmar',
            ],
            152 =>
            [
                'id' => 153,
                'code' => 'NA',
                'name' => 'Namibia',
            ],
            153 =>
            [
                'id' => 154,
                'code' => 'NR',
                'name' => 'Nauru',
            ],
            154 =>
            [
                'id' => 155,
                'code' => 'NP',
                'name' => 'Nepal',
            ],
            155 =>
            [
                'id' => 156,
                'code' => 'NL',
                'name' => 'Netherlands',
            ],
            156 =>
            [
                'id' => 157,
                'code' => 'AN',
                'name' => 'Netherlands Antilles',
            ],
            157 =>
            [
                'id' => 158,
                'code' => 'NC',
                'name' => 'New Caledonia',
            ],
            158 =>
            [
                'id' => 159,
                'code' => 'NZ',
                'name' => 'New Zealand',
            ],
            159 =>
            [
                'id' => 160,
                'code' => 'NI',
                'name' => 'Nicaragua',
            ],
            160 =>
            [
                'id' => 161,
                'code' => 'NE',
                'name' => 'Niger',
            ],
            161 =>
            [
                'id' => 162,
                'code' => 'NG',
                'name' => 'Nigeria',
            ],
            162 =>
            [
                'id' => 163,
                'code' => 'NU',
                'name' => 'Niue',
            ],
            163 =>
            [
                'id' => 164,
                'code' => 'NF',
                'name' => 'Norfolk Island',
            ],
            164 =>
            [
                'id' => 165,
                'code' => 'MP',
                'name' => 'Northern Mariana Islands',
            ],
            165 =>
            [
                'id' => 166,
                'code' => 'NO',
                'name' => 'Norway',
            ],
            166 =>
            [
                'id' => 167,
                'code' => 'OM',
                'name' => 'Oman',
            ],
            167 =>
            [
                'id' => 168,
                'code' => 'PK',
                'name' => 'Pakistan',
            ],
            168 =>
            [
                'id' => 169,
                'code' => 'PW',
                'name' => 'Palau',
            ],
            169 =>
            [
                'id' => 170,
                'code' => 'PS',
                'name' => 'Palestine',
            ],
            170 =>
            [
                'id' => 171,
                'code' => 'PA',
                'name' => 'Panama',
            ],
            171 =>
            [
                'id' => 172,
                'code' => 'PG',
                'name' => 'Papua New Guinea',
            ],
            172 =>
            [
                'id' => 173,
                'code' => 'PY',
                'name' => 'Paraguay',
            ],
            173 =>
            [
                'id' => 174,
                'code' => 'PE',
                'name' => 'Peru',
            ],
            174 =>
            [
                'id' => 175,
                'code' => 'PH',
                'name' => 'Philippines',
            ],
            175 =>
            [
                'id' => 176,
                'code' => 'PN',
                'name' => 'Pitcairn',
            ],
            176 =>
            [
                'id' => 177,
                'code' => 'PL',
                'name' => 'Poland',
            ],
            177 =>
            [
                'id' => 178,
                'code' => 'PT',
                'name' => 'Portugal',
            ],
            178 =>
            [
                'id' => 179,
                'code' => 'PR',
                'name' => 'Puerto Rico',
            ],
            179 =>
            [
                'id' => 180,
                'code' => 'QA',
                'name' => 'Qatar',
            ],
            180 =>
            [
                'id' => 181,
                'code' => 'RE',
                'name' => 'Reunion',
            ],
            181 =>
            [
                'id' => 182,
                'code' => 'RO',
                'name' => 'Romania',
            ],
            182 =>
            [
                'id' => 183,
                'code' => 'RU',
                'name' => 'Russian Federation',
            ],
            183 =>
            [
                'id' => 184,
                'code' => 'RW',
                'name' => 'Rwanda',
            ],
            184 =>
            [
                'id' => 185,
                'code' => 'KN',
                'name' => 'Saint Kitts and Nevis',
            ],
            185 =>
            [
                'id' => 186,
                'code' => 'LC',
                'name' => 'Saint Lucia',
            ],
            186 =>
            [
                'id' => 187,
                'code' => 'VC',
                'name' => 'Saint Vincent and the Grenadines',
            ],
            187 =>
            [
                'id' => 188,
                'code' => 'WS',
                'name' => 'Samoa',
            ],
            188 =>
            [
                'id' => 189,
                'code' => 'SM',
                'name' => 'San Marino',
            ],
            189 =>
            [
                'id' => 190,
                'code' => 'ST',
                'name' => 'Sao Tome and Principe',
            ],
            190 =>
            [
                'id' => 191,
                'code' => 'SA',
                'name' => 'Saudi Arabia',
            ],
            191 =>
            [
                'id' => 192,
                'code' => 'SN',
                'name' => 'Senegal',
            ],
            192 =>
            [
                'id' => 193,
                'code' => 'RS',
                'name' => 'Serbia',
            ],
            193 =>
            [
                'id' => 194,
                'code' => 'SC',
                'name' => 'Seychelles',
            ],
            194 =>
            [
                'id' => 195,
                'code' => 'SL',
                'name' => 'Sierra Leone',
            ],
            195 =>
            [
                'id' => 196,
                'code' => 'SG',
                'name' => 'Singapore',
            ],
            196 =>
            [
                'id' => 197,
                'code' => 'SK',
                'name' => 'Slovakia',
            ],
            197 =>
            [
                'id' => 198,
                'code' => 'SI',
                'name' => 'Slovenia',
            ],
            198 =>
            [
                'id' => 199,
                'code' => 'SB',
                'name' => 'Solomon Islands',
            ],
            199 =>
            [
                'id' => 200,
                'code' => 'SO',
                'name' => 'Somalia',
            ],
            200 =>
            [
                'id' => 201,
                'code' => 'ZA',
                'name' => 'South Africa',
            ],
            201 =>
            [
                'id' => 202,
                'code' => 'GS',
                'name' => 'South Georgia South Sandwich Islands',
            ],
            202 =>
            [
                'id' => 203,
                'code' => 'SS',
                'name' => 'South Sudan',
            ],
            203 =>
            [
                'id' => 204,
                'code' => 'ES',
                'name' => 'Spain',
            ],
            204 =>
            [
                'id' => 205,
                'code' => 'LK',
                'name' => 'Sri Lanka',
            ],
            205 =>
            [
                'id' => 206,
                'code' => 'SH',
                'name' => 'St. Helena',
            ],
            206 =>
            [
                'id' => 207,
                'code' => 'PM',
                'name' => 'St. Pierre and Miquelon',
            ],
            207 =>
            [
                'id' => 208,
                'code' => 'SD',
                'name' => 'Sudan',
            ],
            208 =>
            [
                'id' => 209,
                'code' => 'SR',
                'name' => 'Suriname',
            ],
            209 =>
            [
                'id' => 210,
                'code' => 'SJ',
                'name' => 'Svalbard and Jan Mayen Islands',
            ],
            210 =>
            [
                'id' => 211,
                'code' => 'SZ',
                'name' => 'Swaziland',
            ],
            211 =>
            [
                'id' => 212,
                'code' => 'SE',
                'name' => 'Sweden',
            ],
            212 =>
            [
                'id' => 213,
                'code' => 'CH',
                'name' => 'Switzerland',
            ],
            213 =>
            [
                'id' => 214,
                'code' => 'SY',
                'name' => 'Syrian Arab Republic',
            ],
            214 =>
            [
                'id' => 215,
                'code' => 'TW',
                'name' => 'Taiwan',
            ],
            215 =>
            [
                'id' => 216,
                'code' => 'TJ',
                'name' => 'Tajikistan',
            ],
            216 =>
            [
                'id' => 217,
                'code' => 'TZ',
                'name' => 'Tanzania, United Republic of',
            ],
            217 =>
            [
                'id' => 218,
                'code' => 'TH',
                'name' => 'Thailand',
            ],
            218 =>
            [
                'id' => 219,
                'code' => 'TG',
                'name' => 'Togo',
            ],
            219 =>
            [
                'id' => 220,
                'code' => 'TK',
                'name' => 'Tokelau',
            ],
            220 =>
            [
                'id' => 221,
                'code' => 'TO',
                'name' => 'Tonga',
            ],
            221 =>
            [
                'id' => 222,
                'code' => 'TT',
                'name' => 'Trinidad and Tobago',
            ],
            222 =>
            [
                'id' => 223,
                'code' => 'TN',
                'name' => 'Tunisia',
            ],
            223 =>
            [
                'id' => 224,
                'code' => 'TR',
                'name' => 'Turkey',
            ],
            224 =>
            [
                'id' => 225,
                'code' => 'TM',
                'name' => 'Turkmenistan',
            ],
            225 =>
            [
                'id' => 226,
                'code' => 'TC',
                'name' => 'Turks and Caicos Islands',
            ],
            226 =>
            [
                'id' => 227,
                'code' => 'TV',
                'name' => 'Tuvalu',
            ],
            227 =>
            [
                'id' => 228,
                'code' => 'UG',
                'name' => 'Uganda',
            ],
            228 =>
            [
                'id' => 229,
                'code' => 'UA',
                'name' => 'Ukraine',
            ],
            229 =>
            [
                'id' => 230,
                'code' => 'AE',
                'name' => 'United Arab Emirates',
            ],
            230 =>
            [
                'id' => 231,
                'code' => 'GB',
                'name' => 'United Kingdom',
            ],
            231 =>
            [
                'id' => 232,
                'code' => 'US',
                'name' => 'United States',
            ],
            232 =>
            [
                'id' => 233,
                'code' => 'UM',
                'name' => 'United States minor outlying islands',
            ],
            233 =>
            [
                'id' => 234,
                'code' => 'UY',
                'name' => 'Uruguay',
            ],
            234 =>
            [
                'id' => 235,
                'code' => 'UZ',
                'name' => 'Uzbekistan',
            ],
            235 =>
            [
                'id' => 236,
                'code' => 'VU',
                'name' => 'Vanuatu',
            ],
            236 =>
            [
                'id' => 237,
                'code' => 'VA',
                'name' => 'Vatican City State',
            ],
            237 =>
            [
                'id' => 238,
                'code' => 'VE',
                'name' => 'Venezuela',
            ],
            238 =>
            [
                'id' => 239,
                'code' => 'VN',
                'name' => 'Vietnam',
            ],
            239 =>
            [
                'id' => 240,
                'code' => 'VG',
            'name' => 'Virgin Islands (British)',
            ],
            240 =>
            [
                'id' => 241,
                'code' => 'VI',
            'name' => 'Virgin Islands (U.S.)',
            ],
            241 =>
            [
                'id' => 242,
                'code' => 'WF',
                'name' => 'Wallis and Futuna Islands',
            ],
            242 =>
            [
                'id' => 243,
                'code' => 'EH',
                'name' => 'Western Sahara',
            ],
            243 =>
            [
                'id' => 244,
                'code' => 'YE',
                'name' => 'Yemen',
            ],
            244 =>
            [
                'id' => 245,
                'code' => 'ZM',
                'name' => 'Zambia',
            ],
            245 =>
            [
                'id' => 246,
                'code' => 'ZW',
                'name' => 'Zimbabwe',
            ],
        ]);
    }
};
