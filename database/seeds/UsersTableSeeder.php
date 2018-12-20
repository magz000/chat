<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 1,
                'email' => 'user@gmail.com',
                'password' => '$2y$10$f28kWs8HUbW/lkFO5mr1/uVJT.TtdnwBGx9fayePkv50GzEUsDj.W',
                'first_name' => 'Rebisco',
                'last_name' => 'Support',
                'status' => 1,
                'remember_token' => 'U7sDF8kG5Gmop5QepLqZe3WUEA8bWdXkyKlVq5k3AgSvSnzFUIZWEaVgrHpo',
                'created_at' => '2018-08-02 05:30:15',
                'updated_at' => '2018-11-12 10:59:18',
            ),
            // 1 =>
            // array (
            //     'id' => 2,
            //     'email' => 'wellington.frami@example.org',
            //     'password' => '$2y$10$5.h1a4YGqLYb.2FPDg2lcuPX2F8YuKe6ZnsBD/SZ6P3onRBfPWuoq',
            //     'first_name' => 'Magali',
            //     'last_name' => 'Schoen',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 2 =>
            // array (
            //     'id' => 3,
            //     'email' => 'kling.maudie@example.net',
            //     'password' => '$2y$10$ppMOjdG52pXAsiqlvozJZOhq5HME.z1qREKQ7//ogKfXS8vNZt/ty',
            //     'first_name' => 'Vern',
            //     'last_name' => 'Hilpert',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 3 =>
            // array (
            //     'id' => 4,
            //     'email' => 'javonte51@example.net',
            //     'password' => '$2y$10$KAfxCE1qoGEOaAf1ETdaruV6U1TPE2EU.WpzGyx3uEb/vIx0qJp4O',
            //     'first_name' => 'Ulices',
            //     'last_name' => 'Lesch',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 4 =>
            // array (
            //     'id' => 5,
            //     'email' => 'kling.elise@example.com',
            //     'password' => '$2y$10$dofQerPIN85s4mhEBEbcz.43VWWSxXK0rHOTby8edBQQ6vY092X.O',
            //     'first_name' => 'Myriam',
            //     'last_name' => 'Anderson',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 5 =>
            // array (
            //     'id' => 6,
            //     'email' => 'bernhard.fausto@example.net',
            //     'password' => '$2y$10$gcGwa2H8l7/Osuy0eWJo8OfgPK/gdLPpLrw.NEM/qtLJibQj6gU5m',
            //     'first_name' => 'Kellie',
            //     'last_name' => 'Wiza',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 6 =>
            // array (
            //     'id' => 7,
            //     'email' => 'lubowitz.cornell@example.net',
            //     'password' => '$2y$10$CmQxAVHS0Qdf19No.cQ8kOZ9SalVjAuaVx4mSm3b0WPjjYBDC4kuS',
            //     'first_name' => 'Elmer',
            //     'last_name' => 'Lueilwitz',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 7 =>
            // array (
            //     'id' => 8,
            //     'email' => 'evie.shanahan@example.org',
            //     'password' => '$2y$10$xte4Qajsda04M9Ff.NK5PusUSI/S9F.bEyNgIOvuGnhRz/Jw6lyhm',
            //     'first_name' => 'Marion',
            //     'last_name' => 'Tromp',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 8 =>
            // array (
            //     'id' => 9,
            //     'email' => 'hheathcote@example.com',
            //     'password' => '$2y$10$BMf/iZVty/kQf2BIT8fmyOWctGPMsM2wzcKiTXPGsMR7z4xUGLFm6',
            //     'first_name' => 'Rafael',
            //     'last_name' => 'Simonis',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:16',
            //     'updated_at' => '2018-08-02 05:30:16',
            // ),
            // 9 =>
            // array (
            //     'id' => 10,
            //     'email' => 'trunolfsdottir@example.org',
            //     'password' => '$2y$10$jmGfBkrdWl3OBFhLf1g1z.DTugEFxnqwD.ih1g4Tiv95CmPICuad2',
            //     'first_name' => 'Madelynn',
            //     'last_name' => 'Swift',
            //     'status' => 1,
            //     'remember_token' => NULL,
            //     'created_at' => '2018-08-02 05:30:17',
            //     'updated_at' => '2018-08-02 05:30:17',
            // ),
            // 10 =>
            // array (
            //     'id' => 11,
            //     'email' => 'cora59@example.org',
            //     'password' => '$2y$10$ddg4oTXzCtMS0ZwSGjLPEOFeA.Ndwm4JUz5OLNnyXACN30F5gaE.u',
            //     'first_name' => 'Abagail',
            //     'last_name' => 'Corkery',
            //     'status' => 1,
            //     'remember_token' => 'U9BM6QlnKtNGF7DR8FKYa055lIXSJAxSreruIFA8QTYN1ath0fy9rsl5DeRX',
            //     'created_at' => '2018-08-02 05:30:17',
            //     'updated_at' => '2018-08-02 05:30:17',
            // ),
            11 =>
            array (
                'id' => 12,
                'email' => 'user1@gmail.com',
                'password' => '$2y$10$ReHDVothLnDby4oqPMXyLekGkuzxh4ZYu4TgC0RZ4lJlSbWwG72k6',
                'first_name' => 'sarah',
                'last_name' => 'araojo',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-10-18 07:46:57',
                'updated_at' => '2018-10-26 10:45:52',
            ),
            12 =>
            array (
                'id' => 13,
                'email' => 'user2@gmail.com',
                'password' => '$2y$10$6nCHs1GEdKIfcugM1L8iyuMv40VUEny3NA60S1tJCm9m2UZjfrvDO',
                'first_name' => '456',
                'last_name' => '456',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-10-19 06:25:02',
                'updated_at' => '2018-11-14 14:24:30',
            ),
            13 =>
            array (
                'id' => 14,
                'email' => 'user3@gmail.com',
                'password' => '$2y$10$SpOBeEQji/319CwiSPGJMuwwj1klXuOwENdxlE.2XTQ8alZfSaSRq',
                'first_name' => 'testasd',
                'last_name' => 'asd',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-10-19 07:33:52',
                'updated_at' => '2018-10-19 07:33:52',
            ),
            14 =>
            array (
                'id' => 15,
                'email' => 'user4@gmail.com',
                'password' => '$2y$10$mBYUB24nYNZumDeiMdZruOZYwQ4YxvTA/M5GhrEmObZTCM5RPwM0i',
                'first_name' => 'TONY',
                'last_name' => 'ANG',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-10-22 02:18:34',
                'updated_at' => '2018-11-12 09:44:24',
            ),
            15 =>
            array (
                'id' => 16,
                'email' => 'user6@gmail.com',
                'password' => '$2y$10$6nCHs1GEdKIfcugM1L8iyuMv40VUEny3NA60S1tJCm9m2UZjfrvDO',
                'first_name' => 'CONSTANCIA',
                'last_name' => 'ANG',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-10-22 07:38:09',
                'updated_at' => '2018-10-23 15:06:53',
            ),
            16 =>
            array (
                'id' => 17,
                'email' => 'user5@gmail.com',
                'password' => '$2y$10$qH1.k88KLl5LuaEVY8au3uAeRmw9CYA0eVzVfQzNXPpIzcXj/uiKq',
                'first_name' => 'LYDIA',
                'last_name' => 'CENTENO',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-05 14:40:33',
                'updated_at' => '2018-11-05 14:40:33',
            ),
            17 =>
            array (
                'id' => 18,
                'email' => 'user7@gmail.com',
                'password' => '$2y$10$Wx6MrPSLNPzdo0HfGcXiVOKqVk9yP4TvUAVpZsyN5a3A0WYWmiypi',
                'first_name' => 'susan',
                'last_name' => 'bernardo',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-05 14:49:56',
                'updated_at' => '2018-11-05 14:49:56',
            ),
            18 =>
            array (
                'id' => 19,
                'email' => 'user8@gmail.com',
                'password' => '$2y$10$W1hqgk3QIgxkG4g92qj72.hJ0B5bKdL4nGMpgHZldNjZ2je/BNObC',
                'first_name' => 'MADONNA',
                'last_name' => 'BEN',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-05 15:09:42',
                'updated_at' => '2018-11-05 15:09:42',
            ),
            19 =>
            array (
                'id' => 20,
                'email' => 'user9@gmail.com',
                'password' => '$2y$10$ci8LPldbqVGp.75yUiSL.Ow8QUvKT6iCnTpif5YognC1MR..vFwq6',
                'first_name' => 'ALFONSO',
                'last_name' => 'LAO',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-05 15:18:20',
                'updated_at' => '2018-11-12 09:16:27',
            ),
            20 =>
            array (
                'id' => 21,
                'email' => 'user10@gmail.com',
                'password' => '$2y$10$o4A1DZP9H/QhaydA.3Q7ZebXjd2g.GA6Iy7ry2KpXq9UyKYh23XQ6',
                'first_name' => 'POM',
                'last_name' => 'GOLANGCO',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-06 10:48:32',
                'updated_at' => '2018-11-06 10:48:32',
            ),
            21 =>
            array (
                'id' => 22,
                'email' => 'user12@gmail.com',
                'password' => '$2y$10$3BzWMoWNOjLzzRbVDDrw2.1wfqHzaNa9NKyDaPyuiBZWwWAKLDgMm',
                'first_name' => 'FIRST',
                'last_name' => 'NAME',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2018-11-14 15:46:32',
                'updated_at' => '2018-11-14 15:46:32',
            ),
        ));


    }
}
