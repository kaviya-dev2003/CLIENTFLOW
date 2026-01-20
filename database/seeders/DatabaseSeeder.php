<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // Super Admin
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@clientflow.com',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('Super Admin');

        // Admin
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@clientflow.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('Admin');

        // Staff
        $staff = User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@clientflow.com',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole('Staff');

        // Dummy Data
        $clients = [
            ['name' => 'Acme Corp', 'email' => 'contact@acme.com', 'company' => 'Acme Industries'],
            ['name' => 'Global Tech', 'email' => 'info@globaltech.io', 'company' => 'Global Technology Solutions'],
            ['name' => 'Creative Studio', 'email' => 'hello@creative.com', 'company' => 'Creative Design Co.'],
        ];

        foreach ($clients as $cData) {
            $client = \App\Models\Client::create($cData);
            
            // Create a project for each client
            $project = \App\Models\Project::create([
                'name' => $client->name . ' Website Redesign',
                'client_id' => $client->id,
                'status' => 'Active',
                'budget' => rand(5000, 15000),
                'deadline' => now()->addMonths(2),
            ]);

            // Create an invoice for each project
            \App\Models\Invoice::create([
                'client_id' => $client->id,
                'project_id' => $project->id,
                'total' => $project->budget,
                'status' => 'Unpaid',
            ]);
        }
    }
}
