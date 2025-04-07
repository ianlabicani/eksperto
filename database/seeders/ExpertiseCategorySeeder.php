<?php

namespace Database\Seeders;

use App\Models\ExpertiseCategory;
use Illuminate\Database\Seeder;

class ExpertiseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Web Development' => 'Building and maintaining websites and web applications.',
            'Mobile Development' => 'Creating applications for iOS, Android, and other mobile platforms.',
            'Desktop Development' => 'Developing software applications for desktop environments.',
            'Game Development' => 'Designing and programming video games for various platforms.',
            'DevOps & Sysadmin' => 'Managing infrastructure, servers, and deployment workflows.',
            'Engineering & Product' => 'Involves product development and software engineering practices.',
            'Design & Creative' => 'Graphic design, UI/UX, branding, and other creative services.',
            'Writing' => 'Content creation including articles, blogs, technical writing, and copywriting.',
            'Translation' => 'Converting written content between languages accurately.',
            'Legal' => 'Legal advice, document drafting, and other law-related services.',
            'Admin Support' => 'Virtual assistance, scheduling, data entry, and general administrative help.',
            'Customer Service' => 'Assisting customers via email, chat, or phone with inquiries or support.',
            'Sales & Marketing' => 'Advertising, lead generation, SEO, and other business growth services.',
            'Accounting & Consulting' => 'Financial services including bookkeeping, tax, and business consulting.',
            'Data Science & Analytics' => 'Working with data to extract insights, build models, and visualize trends.',
            'IT & Networking' => 'Managing computer systems, networks, and technical IT support.',
            'Other' => 'Miscellaneous services that don’t fall into specific categories.'
        ];

        foreach ($categories as $name => $description) {
            ExpertiseCategory::updateOrCreate(
                ['name' => $name],
                [
                    'description' => $description,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

    }
}
