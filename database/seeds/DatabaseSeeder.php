<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news_categories')->insert([
            ['CategoryName' => 'Announcements'],
            ['CategoryName' => 'Game News'],
        ]);

        DB::table('support_categories')->insert([
            'CategoryName' => 'General Support'
        ]);

        DB::table('status_categories')->insert([
            ['name' => 'Web Services', 'status' => 1],
            ['name' => 'Game Servers', 'status' => 1],
        ]);

        DB::table('feedback_categories')->insert([
            ['CategoryName' => 'Moderation Issue'],
            ['CategoryName' => 'Event Requests'],
            ['CategoryName' => 'Staff Feedback'],
            ['CategoryName' => 'Other'],
        ]);

        DB::table('report_reasons')->insert([
            ['ReasonName' => 'Spamming'],
            ['ReasonName' => 'Insulting'],
        ]);

        DB::table('permissions')->insert([
            ['id' => 1, 'name' => 'view_admin_sidebar'],
            ['id' => 2, 'name' => 'create_news'],
            ['id' => 3, 'name' => 'manage_rules'],
            ['id' => 4, 'name' => 'manage_feedback'],
            ['id' => 5, 'name' => 'manage_appeals'],
            ['id' => 6, 'name' => 'use_moderation_tools'],
            ['id' => 7, 'name' => 'manage_recruitment'],
            ['id' => 8, 'name' => 'manage_status'],
            ['id' => 9, 'name' => 'manage_users'],
            ['id' => 10, 'name' => 'manage_events'],
            ['id' => 11, 'name' => 'add_user_notes'],
            ['id' => 12, 'name' => 'manage_vtc'],
            ['id' => 13, 'name' => 'access_vtc'],
            ['id' => 14, 'name' => 'manage_support'],
            ['id' => 15, 'name' => 'manage_giveaways'],
            ['id' => 16, 'name' => 'use_inactivity'],
            ['id' => 17, 'name' => 'use_discord_tools'],
            ['id' => 18, 'name' => 'use_project_manager'],
            ['id' => 19, 'name' => 'manage_projects'],
            ['id' => 999, 'name' => 'super_admin'] //DANGER
        ]);

    }
}
