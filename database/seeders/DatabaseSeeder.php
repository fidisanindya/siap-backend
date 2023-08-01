<?php

namespace Database\Seeders;

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
        $this->call([
            PermissionsTableSeeder::class,
            PermissionRoleTableSeeder::class,
            GenderSeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
            AttendeTypeSeeder::class,
            AttendeStatusSeeder::class,
            LeaveCategorySeeder::class,
            ApprovalStatusSeeder::class,
            GovernmentEmployeeGroupSeeder::class,
            HolidaySeeder::class,
            AttendeCodeSeeder::class,
            RolesTableSeeder::class,
            SettingsTableSeeder::class,
            CategoriesTableSeeder::class,
            LeaveCategorySeeder::class,
            MenusTableSeeder::class,
            MenuItemsTableSeeder::class,
            PostsTableSeeder::class,
            PagesTableSeeder::class,
            UsersTableSeeder::class,
            TranslationsTableSeeder::class,
        ]);
    }
}
