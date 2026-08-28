<?php

namespace Database\Seeders\Admin;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = Setting::insert([

            array('id' => '1', 'key' => 'site_name', 'value' => 'DPMart', 'created_at' => '2026-07-03 03:18:10', 'updated_at' => '2026-08-18 18:47:30'),
            array('id' => '2', 'key' => 'site_email', 'value' => 'admin@gmail.com', 'created_at' => '2026-07-03 03:18:10', 'updated_at' => '2026-07-03 03:18:10'),
            array('id' => '3', 'key' => 'country', 'value' => 'AX', 'created_at' => '2026-07-11 03:57:37', 'updated_at' => '2026-08-18 18:47:30'),
            array('id' => '4', 'key' => 'time_zone', 'value' => 'Pacific/Kiritimati', 'created_at' => '2026-07-11 03:57:37', 'updated_at' => '2026-08-18 18:47:30'),
            array('id' => '5', 'key' => 'default_currency', 'value' => 'ZWD', 'created_at' => '2026-07-11 03:57:37', 'updated_at' => '2026-08-18 18:47:30'),
            array('id' => '6', 'key' => 'currency_icon', 'value' => '$', 'created_at' => '2026-07-11 03:57:37', 'updated_at' => '2026-07-11 03:57:37'),
            array('id' => '7', 'key' => 'currency_position', 'value' => 'left', 'created_at' => '2026-07-11 03:57:37', 'updated_at' => '2026-07-11 03:57:37'),
            array('id' => '8', 'key' => 'paypal_mode', 'value' => 'sandbox', 'created_at' => '2026-07-11 17:06:22', 'updated_at' => '2026-07-11 17:06:22'),
            array('id' => '9', 'key' => 'paypal_app_id', 'value' => 'pay paypal', 'created_at' => '2026-07-11 17:06:22', 'updated_at' => '2026-07-16 00:15:21'),
            array('id' => '10', 'key' => 'paypal_client_id', 'value' => 'Aet9GoNL30dozxPVZUNZKOvKbRT03hM_PXRNnd9VnwBqj9LTpSA', 'created_at' => '2026-07-11 17:06:22', 'updated_at' => '2026-07-16 00:15:21'),
            array('id' => '11', 'key' => 'paypal_secret_key', 'value' => 'EHuwyM1KY6_LEB8KOUzFYTtu08bmj_yBGdkqEgwqjR7ZxeCWkpFPquChHaSOfxKSdKV4EGZK755hS7_G', 'created_at' => '2026-07-11 17:06:22', 'updated_at' => '2026-07-16 00:15:21'),
            array('id' => '12', 'key' => 'paypal_status', 'value' => 'active', 'created_at' => '2026-07-11 17:06:22', 'updated_at' => '2026-07-16 00:15:21'),
            array('id' => '13', 'key' => 'paypal_client_id', 'value' => 'Aet9GoNL30dozxPVZUNZKOvKbRT03hM_PXRNnd9VnwBqj9LTpSA-g0otge8RgxQtA6eMRjgKHc_iwuih', 'created_at' => '2026-07-11 19:05:02', 'updated_at' => '2026-07-11 19:05:02'),
            array('id' => '14', 'key' => 'paypal_secret_key', 'value' => 'EHuwyM1KY6_LEB8KOUzFYTtu08bmj_yBGdkqEgwqjR7ZxeCWkpFPquChHaSOfxKSdKV4EGZK755hS7_G', 'created_at' => '2026-07-11 19:05:02', 'updated_at' => '2026-07-11 19:05:02'),
            array('id' => '15', 'key' => 'stripe_publishable_key', 'value' => 'pk_test_51TsXxl34Xw2Uf5HETDGUGFbR4oVBx7QlrLyJdW6nhbUGm3LO8DHXn75pxadmgCYY1YhQrCQtI2JsZpoAVYt6QeC500AHhTQUhV', 'created_at' => '2026-07-13 17:47:21', 'updated_at' => '2026-07-13 17:47:21'),
            array('id' => '16', 'key' => 'stripe_secret_key', 'value' => 'sk_test_51TsXxl34Xw2Uf5HE98xYbWhIN7PzSMiPPTrr2HLMB4XRqppZ8wnXiYZyT0Z6NCg2CqSbrMzI8wPTky16wiTvfQbZ00oIWOPIgV', 'created_at' => '2026-07-13 17:47:22', 'updated_at' => '2026-07-13 17:47:22'),
            array('id' => '17', 'key' => 'stripe_status', 'value' => 'active', 'created_at' => '2026-07-13 17:47:22', 'updated_at' => '2026-07-16 00:08:46'),
            array('id' => '18', 'key' => 'author_commission', 'value' => '5', 'created_at' => '2026-07-16 15:40:09', 'updated_at' => '2026-07-29 04:08:48'),
            array('id' => '19', 'key' => 'contact_phone_1', 'value' => '+1 (800) 123-4567', 'created_at' => '2026-08-17 14:20:43', 'updated_at' => '2026-08-17 14:20:43'),
            array('id' => '20', 'key' => 'contact_phone_2', 'value' => '+1 (800) 987-6543', 'created_at' => '2026-08-17 14:20:43', 'updated_at' => '2026-08-17 14:20:43'),
            array('id' => '21', 'key' => 'contact_email_1', 'value' => 'support@digitalmart.com', 'created_at' => '2026-08-17 14:20:43', 'updated_at' => '2026-08-17 14:20:43'),
            array('id' => '22', 'key' => 'contact_email_2', 'value' => 'info@digitalmart.com', 'created_at' => '2026-08-17 14:20:43', 'updated_at' => '2026-08-17 14:20:43'),
            array('id' => '23', 'key' => 'contact_link_1', 'value' => 'https://help.digitalmart.com', 'created_at' => '2026-08-17 14:20:43', 'updated_at' => '2026-08-17 14:36:38'),
            array('id' => '24', 'key' => 'contact_link_2', 'value' => 'https://community.digitalmart.com', 'created_at' => '2026-08-17 14:20:43', 'updated_at' => '2026-08-17 14:36:38'),
            array('id' => '25', 'key' => 'contact_map', 'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8402891185374!2d144.95373631590425!3d-37.81720974201477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sus!4v1684346452277!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 'created_at' => '2026-08-17 14:24:11', 'updated_at' => '2026-08-17 14:38:08'),
            array('id' => '26', 'key' => 'logo', 'value' => 'uploads/settings/1787081302_6a84b2566d161.png', 'created_at' => '2026-08-18 19:28:23', 'updated_at' => '2026-08-18 19:28:23'),
            array('id' => '27', 'key' => 'footer_logo', 'value' => 'uploads/settings/1787081303_6a84b25779e6c.png', 'created_at' => '2026-08-18 19:28:23', 'updated_at' => '2026-08-18 19:28:23'),
            array('id' => '28', 'key' => 'favicon', 'value' => 'uploads/settings/1787081303_6a84b2577a352.png', 'created_at' => '2026-08-18 19:28:23', 'updated_at' => '2026-08-18 19:28:23'),
            array('id' => '29', 'key' => 'breadcrumb', 'value' => 'uploads/settings/1787081303_6a84b2577a9fa.jpg', 'created_at' => '2026-08-18 19:28:23', 'updated_at' => '2026-08-18 19:28:23'),
            array('id' => '30', 'key' => 'smtp_sender_name', 'value' => 'D-smart', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '31', 'key' => 'smtp_sender_email', 'value' => 'support@d-smart.com', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '32', 'key' => 'smtp_recipient_email', 'value' => 'contact@dc.com', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '33', 'key' => 'smtp_host', 'value' => 'sandbox.smtp.mailtrap.io', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '34', 'key' => 'smtp_username', 'value' => '822992cab8e5e6', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '35', 'key' => 'smtp_password', 'value' => '512d54f5d50a52', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '36', 'key' => 'smtp_port', 'value' => '2525', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51'),
            array('id' => '37', 'key' => 'smtp_encryption', 'value' => 'ssl', 'created_at' => '2026-08-19 04:05:51', 'updated_at' => '2026-08-19 04:05:51')
        ]);
    }
}
