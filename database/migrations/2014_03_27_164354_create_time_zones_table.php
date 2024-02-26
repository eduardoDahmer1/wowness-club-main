<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timezones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('timezone');
            $table->timestamps();
        });
        $this->insertTimezones();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timezones');
    }

    private function insertTimezones(): void
    {
        DB::table('timezones')->insert([
            0 =>
            [
                'id' => 1,
                'name' => 'UTC/GMT +00:00 London, Lisbon, Dublin, Edinburgh',
                'timezone' => 0.00,
            ],
            1 =>
            [
                'id' => 2,
                'name' => 'UTC/GMT +00:00 WET Marrakesh, Madeira',
                'timezone' => 0.00,
            ],
            2 =>
            [
                'id' => 3,
                'name' => 'UTC/GMT +01:00 (British Summer Time) London, Lisbon, Dublin, Edinburgh',
                'timezone' => 1.00,
            ],
            3 =>
            [
                'id' => 4,
                'name' => 'UTC/GMT +01:00 CET Europe/Madrid, Paris, Amsterdam',
                'timezone' => 1.00,
            ],
            4 =>
            [
                'id' => 5,
                'name' => 'UTC/GMT +01:00 CET Berlin, Vienna, Zurich',
                'timezone' => 1.00,
            ],
            5 =>
            [
                'id' => 6,
                'name' => 'GUTC/GMT CET +01:00 Rome, Milan, Malta',
                'timezone' => 1.00,
            ],
            6 =>
            [
                'id' => 7,
                'name' => 'UTC/GMT +01:00 CET Budapest, Bucharest, Prague, Warsaw',
                'timezone' => 1.00,
            ],
            7 =>
            [
                'id' => 8,
                'name' => 'UTC/GMT +01:00 CET Albania, Serbia, Bratislavia, Ljubljana',
                'timezone' => 1.00,
            ],
            8 =>
            [
                'id' => 9,
                'name' => 'UTC/GMT +01:00 CET Oslo, Stockholm, Copenhagen, Zagreb',
                'timezone' => 1.00,
            ],
            9 =>
            [
                'id' => 10,
                'name' => 'UTC/GMT +01:00 WEST Marrakesh, Madeira',
                'timezone' => 1.00,
            ],
            10 =>
            [
                'id' => 11,
                'name' => 'UTC/GMT +01:00 Argelia, Angola',
                'timezone' => 1.00,
            ],
            11 =>
            [
                'id' => 12,
                'name' => 'UTC/GMT +01:00 CET Tunisias',
                'timezone' => 1.00,
            ],
            12 =>
            [
                'id' => 13,
                'name' => 'UTC/GMT +01:00 WAST Lagos',
                'timezone' => 1.00,
            ],
            13 =>
            [
                'id' => 14,
                'name' => 'UTC/GMT +02:00 CEST Europe/Madrid, Paris, Amsterdam',
                'timezone' => 2.00,
            ],
            14 =>
            [
                'id' => 15,
                'name' => 'UTC/GMT +02:00 CEST Berlin, Vienna, Zurich',
                'timezone' => 2.00,
            ],
            15 =>
            [
                'id' => 16,
                'name' => 'UTC/GMT CEST +02:00 Rome, Milan, Malta',
                'timezone' => 2.00,
            ],
            16 =>
            [
                'id' => 17,
                'name' => 'UTC/GMT +02:00 CEST Budapest, Bucharest, Prague, Warsaw',
                'timezone' => 2.00,
            ],
            17 =>
            [
                'id' => 18,
                'name' => 'UTC/GMT +02:00 CEST Albania, Serbia, Bratislavia, Ljubljana',
                'timezone' => 2.00,
            ],
            18 =>
            [
                'id' => 19,
                'name' => 'UTC/GMT +02:00 CEST Oslo, Stockholm, Copenhagen, Zagreb',
                'timezone' => 2.00,
            ],
            19 =>
            [
                'id' => 20,
                'name' => 'UTC/GMT +02:00 EET Athens, Bucharest, Helsinki',
                'timezone' => 2.00,
            ],
            20 =>
            [
                'id' => 21,
                'name' => 'UTC/GMT +02:00 EET Vilnius, Riga, Tallin, Cyprus, Sofia',
                'timezone' => 2.00,
            ],
            21 =>
            [
                'id' => 22,
                'name' => 'UTC/GMT +02:00 Cape Town, Johannesburg, Cairo',
                'timezone' => 2.00,
            ],
            22 =>
            [
                'id' => 23,
                'name' => 'UTC/GMT +03:00 Nairobi, Tanzania, Kongo',
                'timezone' => 3.00,
            ],
            23 =>
            [
                'id' => 24,
                'name' => 'UTC/GMT +03:00 EEST Athens, Bucharest, Helsinki',
                'timezone' => 3.00,
            ],
            24 =>
            [
                'id' => 25,
                'name' => 'UTC/GMT +03:00 MSK Moscow',
                'timezone' => 3.00,
            ],
            25 =>
            [
                'id' => 26,
                'name' => 'UTC/GMT +03:00 EEST Vilnius, Riga, Tallin, Cyprus, Sofia',
                'timezone' => 3.00,
            ],
            26 =>
            [
                'id' => 27,
                'name' => 'UTC/GMT +03:00 TRT Istanbul',
                'timezone' => 3.00,
            ],
            27 =>
            [
                'id' => 28,
                'name' => 'UTC/GMT +04:00 GST Dubai, United Arab Emirates',
                'timezone' => 4.00,
            ],
            28 =>
            [
                'id' => 29,
                'name' => 'UTC/GMT +05:00 TMT Ashgabat, Uzbekistan',
                'timezone' => 5.00,
            ],
            29 =>
            [
                'id' => 30,
                'name' => 'UTC/GMT +05:30 IST New Delhi, India',
                'timezone' => 5.30,
            ],
            30 =>
            [
                'id' => 31,
                'name' => 'UTC/GMT +06:00 Bangladesh, Dhaka',
                'timezone' => 6.00,
            ],
            31 =>
            [
                'id' => 32,
                'name' => 'UTC/GMT +07:00 Bangkok, Hanoi, Khovd, Jakarta',
                'timezone' => 7.00,
            ],
            32 =>
            [
                'id' => 33,
                'name' => 'UTC/GMT +08:00 ULAT, Ulaanbaatar',
                'timezone' => 8.00,
            ],
            33 =>
            [
                'id' => 34,
                'name' => 'UTC/GMT +08:00 Bali, Kuala Lumpur',
                'timezone' => 8.00,
            ],
            34 =>
            [
                'id' => 35,
                'name' => 'UTC/GMT +08:00 HKT Hong Kong',
                'timezone' => 8.00,
            ],
            35 =>
            [
                'id' => 36,
                'name' => 'UTC/GMT +08:00 Singapore',
                'timezone' => 8.00,
            ],
            36 =>
            [
                'id' => 37,
                'name' => 'UTC/GMT +08:00 AWST Perth',
                'timezone' => 8.00,
            ],
            37 =>
            [
                'id' => 38,
                'name' => 'UTC/GMT +09:00 JST Tokyo, Japan',
                'timezone' => 9.00,
            ],
            38 =>
            [
                'id' => 39,
                'name' => 'UTC/GMT +09:30 ACST Darwin',
                'timezone' => 9.30,
            ],
            39 =>
            [
                'id' => 40,
                'name' => 'UTC/GMT +09:30 ACST Adelaide',
                'timezone' => 9.30,
            ],
            40 =>
            [
                'id' => 41,
                'name' => 'UTC/GMT +10:00 AEST Sydney, Melbourne, Gold Coast, Brisbane, Canberra',
                'timezone' => 10.00,
            ],
            41 =>
            [
                'id' => 42,
                'name' => 'UTC/GMT +10:30 Adelaide (Daylight Saving Time)',
                'timezone' => 10.30,
            ],
            42 =>
            [
                'id' => 43,
                'name' => 'UTC/GMT +11:00 AEDT Sydney, Melbourne, Gold Coast, Brisbane, Canberra',
                'timezone' => 11.00,
            ],
            43 =>
            [
                'id' => 44,
                'name' => 'UTC/GMT +12:00 FST Fiji Standard Time',
                'timezone' => 12.00,
            ],
            44 =>
            [
                'id' => 45,
                'name' => 'UTC/GMT -01:00 Reykjavik',
                'timezone' => -1.00,
            ],
            45 =>
            [
                'id' => 46,
                'name' => 'UTC/GMT -01:00 Senegal, Cabo Verde',
                'timezone' => -1.00,
            ],
            46 =>
            [
                'id' => 47,
                'name' => 'UTC/GMT -02:00 FNT Fernando de Noronha',
                'timezone' => -2.00,
            ],
            47 =>
            [
                'id' => 48,
                'name' => 'UTC/GMT -03:00 Brasilia, Sao Paulo, Rio de Janeiro',
                'timezone' => -3.00,
            ],
            48 =>
            [
                'id' => 49,
                'name' => 'UTC/GMT -03:00 Buenos Aires, Montevideo',
                'timezone' => -3.00,
            ],
            49 =>
            [
                'id' => 50,
                'name' => 'UTC/GMT -03:00 CLST Santiago Chile',
                'timezone' => -3.00,
            ],
            50 =>
            [
                'id' => 51,
                'name' => 'UTC/GMT -03:00 ADT Bermuda',
                'timezone' => -3.00,
            ],
            51 =>
            [
                'id' => 52,
                'name' => 'UTC/GMT -04:00 EDT New York, Washington DC, Miami',
                'timezone' => -4.00,
            ],
            52 =>
            [
                'id' => 53,
                'name' => 'UTC/GMT -04:00 EDT Toronto, Montreal, Ontario, Quebec, Ottawa',
                'timezone' => -4.00,
            ],
            53 =>
            [
                'id' => 54,
                'name' => 'UTC/GMT -04:00 AMT Manaus',
                'timezone' => -4.00,
            ],
            54 =>
            [
                'id' => 55,
                'name' => 'UTC/GMT -04:00 Asuncion',
                'timezone' => -4.00,
            ],
            55 =>
            [
                'id' => 56,
                'name' => 'UTC/GMT -04:00 COT Bogota, Caracas, La Paz',
                'timezone' => -4.00,
            ],
            56 =>
            [
                'id' => 57,
                'name' => 'UTC/GMT -04:00 CLT Santiago Chile',
                'timezone' => -4.00,
            ],
            57 =>
            [
                'id' => 58,
                'name' => 'UTC/GMT -04:00 AST Bermuda',
                'timezone' => -4.00,
            ],
            58 =>
            [
                'id' => 59,
                'name' => 'UTC/GMT -04:00 AST Aruba, Dominican Republic, Dominica',
                'timezone' => -4.00,
            ],
            59 =>
            [
                'id' => 60,
                'name' => 'UTC/GMT -04:00 CDT Havana, Cuba',
                'timezone' => -4.00,
            ],
            60 =>
            [
                'id' => 61,
                'name' => 'UTC/GMT -04:00 FKT Falkland Island Time',
                'timezone' => -4.00,
            ],
            61 =>
            [
                'id' => 62,
                'name' => 'UTC/GMT -04:00 GYT Guyana',
                'timezone' => -4.00,
            ],
            62 =>
            [
                'id' => 63,
                'name' => 'UTC/GMT -04:00 Cayman Islands Daylight Saving Time',
                'timezone' => -4.00,
            ],
            63 =>
            [
                'id' => 64,
                'name' => 'UTC/GMT -04:00 AST Anguilla, Antigua and Barbuda',
                'timezone' => -4.00,
            ],
            64 =>
            [
                'id' => 65,
                'name' => 'UTC/GMT -04:00 Barbados , British Virgin Islands, US Virgin Islands',
                'timezone' => -4.00,
            ],
            65 =>
            [
                'id' => 66,
                'name' => 'UTC/GMT -04:00 Caribbean Netherlands',
                'timezone' => -4.00,
            ],
            66 =>
            [
                'id' => 67,
                'name' => 'UTC/GMT -04:00 Curaçao',
                'timezone' => -4.00,
            ],
            67 =>
            [
                'id' => 68,
                'name' => 'UTC/GMT -04:00 Grenada',
                'timezone' => -4.00,
            ],
            68 =>
            [
                'id' => 69,
                'name' => 'UTC/GMT -04:00 Guadeloupe',
                'timezone' => -4.00,
            ],
            69 =>
            [
                'id' => 70,
                'name' => 'UTC/GMT -04:00 Montserrat',
                'timezone' => -4.00,
            ],
            70 =>
            [
                'id' => 71,
                'name' => 'UTC/GMT -04:00 Puerto Rico',
                'timezone' => -4.00,
            ],
            71 =>
            [
                'id' => 72,
                'name' => 'UTC/GMT -04:00 Saint Barthélemy',
                'timezone' => -4.00,
            ],
            72 =>
            [
                'id' => 73,
                'name' => 'UTC/GMT -04:00 Saint Kitts and Nevis',
                'timezone' => -4.00,
            ],
            73 =>
            [
                'id' => 74,
                'name' => 'UTC/GMT -04:00 Saint Martin, Saint Lucia, Sint Maarten , Martinique',
                'timezone' => -4.00,
            ],
            74 =>
            [
                'id' => 75,
                'name' => 'UTC/GMT -04:00 Saint Vincent and Grenadines',
                'timezone' => -4.00,
            ],
            75 =>
            [
                'id' => 76,
                'name' => 'UTC/GMT -04:00 Trinidad and Tobago',
                'timezone' => -4.00,
            ],
            76 =>
            [
                'id' => 77,
                'name' => 'UTC/GMT -04:00 Turks and Caicos Islands',
                'timezone' => -4.00,
            ],
            77 =>
            [
                'id' => 78,
                'name' => 'UTC/GMT -05:00 EST Cancun, Quintana Roo',
                'timezone' => -5.00,
            ],
            78 =>
            [
                'id' => 79,
                'name' => 'UTC/GMT -05:00 EST - New York, Washington DC, Miami',
                'timezone' => -5.00,
            ],
            79 =>
            [
                'id' => 80,
                'name' => 'UTC/GMT -05:00 EST - Toronto, Montreal, Ontario, Quebec, Ottawa',
                'timezone' => -5.00,
            ],
            80 =>
            [
                'id' => 81,
                'name' => 'UTC/GMT -05:00 CDT Houston, Dallas, Toronto',
                'timezone' => -5.00,
            ],
            81 =>
            [
                'id' => 82,
                'name' => 'UTC/GMT -05:00 ACT Acre',
                'timezone' => -5.00,
            ],
            82 =>
            [
                'id' => 83,
                'name' => 'UTC/GMT –05:00 PET Lima, Peru',
                'timezone' => -5.00,
            ],
            83 =>
            [
                'id' => 84,
                'name' => 'UTC/GMT -05:00 ECT Quito, Ecuador',
                'timezone' => -5.00,
            ],
            84 =>
            [
                'id' => 85,
                'name' => 'UTC/GMT -06:00 CST San Jose, Costa Rica',
                'timezone' => -6.00,
            ],
            85 =>
            [
                'id' => 86,
                'name' => 'UTC/GMT -06:00 CST Mexico City, Merida',
                'timezone' => -6.00,
            ],
            86 =>
            [
                'id' => 87,
                'name' => 'UTC/GMT -06:00 CST Belize City',
                'timezone' => -6.00,
            ],
            87 =>
            [
                'id' => 88,
                'name' => 'UTC/GMT -06:00 CST Houston, Dallas, Toronto',
                'timezone' => -6.00,
            ],
            88 =>
            [
                'id' => 89,
                'name' => 'UTC/GMT -06:00 MDT Phoenix (Arizona), Denver (Colorado)',
                'timezone' => -6.00,
            ],
            89 =>
            [
                'id' => 90,
                'name' => 'UTC/GMT -07:00 MST Phoenix (Arizona), Denver (Colorado)',
                'timezone' => -7.00,
            ],
            90 =>
            [
                'id' => 91,
                'name' => 'UTC/GMT -07:00 PDT Los Angeles, San Francisco, Las Vegas, Vancouver',
                'timezone' => -7.00,
            ],
            91 =>
            [
                'id' => 92,
                'name' => 'UTC/GMT -08:00 PST Los Angeles, San Francisco, Las Vegas, Vancouver',
                'timezone' => -8.00,
            ],
            92 =>
            [
                'id' => 93,
                'name' => 'UTC/GMT -10:00 Hawaii',
                'timezone' => -10.00,
            ]
        ]);
    }
};
