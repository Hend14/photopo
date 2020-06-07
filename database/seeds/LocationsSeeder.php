<?php

use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location_list = [
            ['code' => 0, 'prefecture' => 'Select Your Prefecture'],
            ['code' => 1, 'prefecture' => '北海道'],
            ['code' => 2, 'prefecture' => '青森県'],
            ['code' => 3, 'prefecture' => '岩手県'],
            ['code' => 4, 'prefecture' => '宮城県'],
            ['code' => 5, 'prefecture' => '秋田県'],
            ['code' => 6, 'prefecture' => '山形県'],
            ['code' => 7, 'prefecture' => '福島県'],
            ['code' => 8, 'prefecture' => '茨城県'],
            ['code' => 9, 'prefecture' => '栃木県'],
            ['code' => 10, 'prefecture' => '群馬県'],
            ['code' => 11, 'prefecture' => '埼玉県'],
            ['code' => 12, 'prefecture' => '千葉県'],
            ['code' => 13, 'prefecture' => '東京都'],
            ['code' => 14, 'prefecture' => '神奈川県'],
            ['code' => 15, 'prefecture' => '新潟県'],
            ['code' => 16, 'prefecture' => '富山県'],
            ['code' => 17, 'prefecture' => '石川県'],
            ['code' => 18, 'prefecture' => '福井県'],
            ['code' => 19, 'prefecture' => '山梨県'],
            ['code' => 20, 'prefecture' => '長野県'],
            ['code' => 21, 'prefecture' => '岐阜県'],
            ['code' => 22, 'prefecture' => '静岡県'],
            ['code' => 23, 'prefecture' => '愛知県'],
            ['code' => 24, 'prefecture' => '三重県'],
            ['code' => 25, 'prefecture' => '滋賀県'],
            ['code' => 26, 'prefecture' => '京都府'],
            ['code' => 27, 'prefecture' => '大阪府'],
            ['code' => 28, 'prefecture' => '兵庫県'],
            ['code' => 29, 'prefecture' => '奈良県'],
            ['code' => 30, 'prefecture' => '和歌山県'],
            ['code' => 31, 'prefecture' => '鳥取県'],
            ['code' => 32, 'prefecture' => '島根県'],
            ['code' => 33, 'prefecture' => '岡山県'],
            ['code' => 34, 'prefecture' => '広島県'],
            ['code' => 35, 'prefecture' => '山口県'],
            ['code' => 36, 'prefecture' => '徳島県'],
            ['code' => 37, 'prefecture' => '香川県'],
            ['code' => 38, 'prefecture' => '愛媛県'],
            ['code' => 39, 'prefecture' => '高知県'],
            ['code' => 40, 'prefecture' => '福岡県'],
            ['code' => 41, 'prefecture' => '佐賀県'],
            ['code' => 42, 'prefecture' => '長崎県'],
            ['code' => 43, 'prefecture' => '熊本県'],
            ['code' => 44, 'prefecture' => '大分県'],
            ['code' => 45, 'prefecture' => '宮崎県'],
            ['code' => 46, 'prefecture' => '鹿児島県'],
            ['code' => 47, 'prefecture' => '沖縄県'],
        ];
        DB::table('location_list')->insert($location_list);
    }
}
