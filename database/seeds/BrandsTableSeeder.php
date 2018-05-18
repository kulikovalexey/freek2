<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()  //:TODO save _name strtolower
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 106414,
                'name' => 'QNAP',
            ),
            1 => 
            array (
                'id' => 106415,
                'name' => 'Synology',
            ),
            2 => 
            array (
                'id' => 106418,
                'name' => 'Asustor',
            ),
            3 => 
            array (
                'id' => 106419,
                'name' => 'Thecus',
            ),
            4 => 
            array (
                'id' => 106421,
                'name' => 'Western Digital',
            ),
            5 => 
            array (
                'id' => 106422,
                'name' => 'Seagate',
            ),
            6 => 
            array (
                'id' => 106423,
                'name' => 'Foscam',
            ),
            7 => 
            array (
                'id' => 106424,
                'name' => 'HQ',
            ),
            8 => 
            array (
                'id' => 106425,
                'name' => 'Brickcom',
            ),
            9 => 
            array (
                'id' => 106426,
                'name' => 'HGST',
            ),
            10 => 
            array (
                'id' => 123989,
                'name' => 'Netgear',
            ),
            11 => 
            array (
                'id' => 135264,
                'name' => 'ACTi',
            ),
            12 => 
            array (
                'id' => 231075,
                'name' => 'Samsung',
            ),
            13 => 
            array (
                'id' => 248609,
                'name' => 'Axis',
            ),
            14 => 
            array (
                'id' => 258311,
                'name' => 'D-Link',
            ),
            15 => 
            array (
                'id' => 258325,
                'name' => 'Hikvision',
            ),
            16 => 
            array (
                'id' => 338815,
                'name' => 'PANASONIC',
            ),
            17 => 
            array (
                'id' => 343421,
                'name' => 'Drobo',
            ),
            18 => 
            array (
                'id' => 364063,
                'name' => 'Sharkoon',
            ),
            19 => 
            array (
                'id' => 364065,
                'name' => 'G-Technology',
            ),
            20 => 
            array (
                'id' => 364577,
                'name' => 'iWalk',
            ),
            21 => 
            array (
                'id' => 369923,
                'name' => 'Engenius',
            ),
            22 => 
            array (
                'id' => 369925,
                'name' => 'Zyxel',
            ),
            23 => 
            array (
                'id' => 372795,
                'name' => 'CalDigit',
            ),
            24 => 
            array (
                'id' => 372797,
                'name' => 'Raidon',
            ),
            25 => 
            array (
                'id' => 372799,
                'name' => 'Devolo',
            ),
            26 => 
            array (
                'id' => 373073,
                'name' => 'Eaton',
            ),
            27 => 
            array (
                'id' => 373075,
                'name' => 'ICY BOX',
            ),
            28 => 
            array (
                'id' => 373081,
                'name' => 'APC',
            ),
            29 => 
            array (
                'id' => 373103,
                'name' => 'Glyph',
            ),
            30 => 
            array (
                'id' => 373107,
                'name' => 'Integral',
            ),
            31 => 
            array (
                'id' => 392107,
                'name' => 'TP-LINK',
            ),
            32 => 
            array (
                'id' => 408150,
                'name' => 'ACT',
            ),
            33 => 
            array (
                'id' => 408152,
                'name' => 'ioSafe',
            ),
            34 => 
            array (
                'id' => 408156,
                'name' => 'Intel',
            ),
            35 => 
            array (
                'id' => 532166,
                'name' => 'YEALINK',
            ),
            36 => 
            array (
                'id' => 650818,
                'name' => 'HyperDrive',
            ),
            37 => 
            array (
                'id' => 652056,
                'name' => 'Apple',
            ),
            38 => 
            array (
                'id' => 731238,
                'name' => 'Snom',
            ),
            39 => 
            array (
                'id' => 752834,
                'name' => 'The Little Black Box',
            ),
            40 => 
            array (
                'id' => 942251,
                'name' => 'Kingston',
            ),
            41 => 
            array (
                'id' => 951110,
                'name' => 'GIGASET',
            ),
            42 => 
            array (
                'id' => 995585,
                'name' => 'Venz',
            ),
            43 => 
            array (
                'id' => 1205645,
                'name' => 'Promise',
            ),
            44 => 
            array (
                'id' => 1242413,
                'name' => 'Ubiquiti',
            ),
            45 => 
            array (
                'id' => 1267343,
                'name' => 'Dahua',
            ),
            46 => 
            array (
                'id' => 1478057,
                'name' => 'Angelbird',
            ),
            47 => 
            array (
                'id' => 1478060,
                'name' => 'BabyPing',
            ),
            48 => 
            array (
                'id' => 1478063,
                'name' => 'DrayTek',
            ),
            49 => 
            array (
                'id' => 1478066,
                'name' => 'Duracell',
            ),
            50 => 
            array (
                'id' => 1478069,
                'name' => 'Fantec',
            ),
            51 => 
            array (
                'id' => 1478075,
                'name' => 'HD Digitech',
            ),
            52 => 
            array (
                'id' => 1478078,
                'name' => 'Kensington',
            ),
            53 => 
            array (
                'id' => 1478084,
                'name' => 'OEM',
            ),
            54 => 
            array (
                'id' => 1478165,
                'name' => 'QSAN XCube',
            ),
            55 => 
            array (
                'id' => 1478168,
                'name' => 'ROCKI',
            ),
            56 => 
            array (
                'id' => 1478171,
                'name' => 'SanDisk',
            ),
            57 => 
            array (
                'id' => 1478174,
                'name' => 'Tandberg Data',
            ),
            58 => 
            array (
                'id' => 1478177,
                'name' => 'u2o',
            ),
            59 => 
            array (
                'id' => 1478180,
                'name' => 'Y-cam',
            ),
            60 => 
            array (
                'id' => 1580639,
                'name' => 'Asus',
            ),
            61 => 
            array (
                'id' => 1584710,
                'name' => 'StarTech',
            ),
            62 => 
            array (
                'id' => 1584713,
                'name' => 'Toshiba',
            ),
            63 => 
            array (
                'id' => 1618604,
                'name' => 'Kodak',
            ),
            64 => 
            array (
                'id' => 1619018,
                'name' => 'Buffalo',
            ),
            65 => 
            array (
                'id' => 1622291,
                'name' => 'Linksys',
            ),
            66 => 
            array (
                'id' => 1640303,
                'name' => 'Mikrotik',
            ),
            67 => 
            array (
                'id' => 1711268,
                'name' => 'Fibaro',
            ),
            68 => 
            array (
                'id' => 1759313,
                'name' => 'DoorBird',
            ),
            69 => 
            array (
                'id' => 1764299,
                'name' => 'Crucial',
            ),
            70 => 
            array (
                'id' => 1767743,
                'name' => 'Sapphire',
            ),
            71 => 
            array (
                'id' => 1776974,
                'name' => 'Dell',
            ),
            72 => 
            array (
                'id' => 1873208,
                'name' => 'AMD',
            ),
            73 => 
            array (
                'id' => 2546135,
                'name' => 'DJI',
            ),
            74 => 
            array (
                'id' => 2641490,
                'name' => 'LaCie',
            ),
        ));
        
        
    }
}