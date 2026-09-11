<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // Users
            [
                'name' => 'Users View',
                'slug' => 'users.view',
                'module' => 'users',
                'description' => 'View users',
                'status' => true,
            ],
            [
                'name' => 'Users Create',
                'slug' => 'users.create',
                'module' => 'users',
                'description' => 'Create users',
                'status' => true,
            ],
            [
                'name' => 'Users Edit',
                'slug' => 'users.edit',
                'module' => 'users',
                'description' => 'Edit users',
                'status' => true,
            ],
            [
                'name' => 'Users Delete',
                'slug' => 'users.delete',
                'module' => 'users',
                'description' => 'Delete users',
                'status' => true,
            ],

            // Services
            [
                'name' => 'Services View',
                'slug' => 'services.view',
                'module' => 'services',
                'description' => 'View services',
                'status' => true,
            ],
            [
                'name' => 'Services Create',
                'slug' => 'services.create',
                'module' => 'services',
                'description' => 'Create services',
                'status' => true,
            ],
            [
                'name' => 'Services Edit',
                'slug' => 'services.edit',
                'module' => 'services',
                'description' => 'Edit services',
                'status' => true,
            ],
            [
                'name' => 'Services Delete',
                'slug' => 'services.delete',
                'module' => 'services',
                'description' => 'Delete services',
                'status' => true,
            ],

            // Projects
            [
                'name' => 'Projects View',
                'slug' => 'projects.view',
                'module' => 'projects',
                'description' => 'View projects',
                'status' => true,
            ],
            [
                'name' => 'Projects Create',
                'slug' => 'projects.create',
                'module' => 'projects',
                'description' => 'Create projects',
                'status' => true,
            ],
            [
                'name' => 'Projects Edit',
                'slug' => 'projects.edit',
                'module' => 'projects',
                'description' => 'Edit projects',
                'status' => true,
            ],
            [
                'name' => 'Projects Delete',
                'slug' => 'projects.delete',
                'module' => 'projects',
                'description' => 'Delete projects',
                'status' => true,
            ],

            // Technologies
            [
                'name' => 'Technologies View',
                'slug' => 'technologies.view',
                'module' => 'technologies',
                'description' => 'View technologies',
                'status' => true,
            ],
            [
                'name' => 'Technologies Create',
                'slug' => 'technologies.create',
                'module' => 'technologies',
                'description' => 'Create technologies',
                'status' => true,
            ],
            [
                'name' => 'Technologies Edit',
                'slug' => 'technologies.edit',
                'module' => 'technologies',
                'description' => 'Edit technologies',
                'status' => true,
            ],
            [
                'name' => 'Technologies Delete',
                'slug' => 'technologies.delete',
                'module' => 'technologies',
                'description' => 'Delete technologies',
                'status' => true,
            ],

            // Pages
            [
                'name' => 'Pages View',
                'slug' => 'pages.view',
                'module' => 'pages',
                'description' => 'View pages',
                'status' => true,
            ],
            [
                'name' => 'Pages Create',
                'slug' => 'pages.create',
                'module' => 'pages',
                'description' => 'Create pages',
                'status' => true,
            ],
            [
                'name' => 'Pages Edit',
                'slug' => 'pages.edit',
                'module' => 'pages',
                'description' => 'Edit pages',
                'status' => true,
            ],
            [
                'name' => 'Pages Delete',
                'slug' => 'pages.delete',
                'module' => 'pages',
                'description' => 'Delete pages',
                'status' => true,
            ],

            // Menus
            [
                'name' => 'Menus View',
                'slug' => 'menus.view',
                'module' => 'menus',
                'description' => 'View menus',
                'status' => true,
            ],
            [
                'name' => 'Menus Create',
                'slug' => 'menus.create',
                'module' => 'menus',
                'description' => 'Create menus',
                'status' => true,
            ],
            [
                'name' => 'Menus Edit',
                'slug' => 'menus.edit',
                'module' => 'menus',
                'description' => 'Edit menus',
                'status' => true,
            ],
            [
                'name' => 'Menus Delete',
                'slug' => 'menus.delete',
                'module' => 'menus',
                'description' => 'Delete menus',
                'status' => true,
            ],

            // Sliders
            [
                'name' => 'Sliders View',
                'slug' => 'sliders.view',
                'module' => 'sliders',
                'description' => 'View sliders',
                'status' => true,
            ],
            [
                'name' => 'Sliders Create',
                'slug' => 'sliders.create',
                'module' => 'sliders',
                'description' => 'Create sliders',
                'status' => true,
            ],
            [
                'name' => 'Sliders Edit',
                'slug' => 'sliders.edit',
                'module' => 'sliders',
                'description' => 'Edit sliders',
                'status' => true,
            ],
            [
                'name' => 'Sliders Delete',
                'slug' => 'sliders.delete',
                'module' => 'sliders',
                'description' => 'Delete sliders',
                'status' => true,
            ],

            // Blogs
            [
                'name' => 'Blogs View',
                'slug' => 'blogs.view',
                'module' => 'blogs',
                'description' => 'View blogs',
                'status' => true,
            ],
            [
                'name' => 'Blogs Create',
                'slug' => 'blogs.create',
                'module' => 'blogs',
                'description' => 'Create blogs',
                'status' => true,
            ],
            [
                'name' => 'Blogs Edit',
                'slug' => 'blogs.edit',
                'module' => 'blogs',
                'description' => 'Edit blogs',
                'status' => true,
            ],
            [
                'name' => 'Blogs Delete',
                'slug' => 'blogs.delete',
                'module' => 'blogs',
                'description' => 'Delete blogs',
                'status' => true,
            ],

            // Albums
            [
                'name' => 'Albums View',
                'slug' => 'albums.view',
                'module' => 'albums',
                'description' => 'View albums',
                'status' => true,
            ],
            [
                'name' => 'Albums Create',
                'slug' => 'albums.create',
                'module' => 'albums',
                'description' => 'Create albums',
                'status' => true,
            ],
            [
                'name' => 'Albums Edit',
                'slug' => 'albums.edit',
                'module' => 'albums',
                'description' => 'Edit albums',
                'status' => true,
            ],
            [
                'name' => 'Albums Delete',
                'slug' => 'albums.delete',
                'module' => 'albums',
                'description' => 'Delete albums',
                'status' => true,
            ],

            // Gallery
            [
                'name' => 'Gallery View',
                'slug' => 'gallery.view',
                'module' => 'gallery',
                'description' => 'View gallery images',
                'status' => true,
            ],
            [
                'name' => 'Gallery Create',
                'slug' => 'gallery.create',
                'module' => 'gallery',
                'description' => 'Create gallery images',
                'status' => true,
            ],
            [
                'name' => 'Gallery Edit',
                'slug' => 'gallery.edit',
                'module' => 'gallery',
                'description' => 'Edit gallery images',
                'status' => true,
            ],
            [
                'name' => 'Gallery Delete',
                'slug' => 'gallery.delete',
                'module' => 'gallery',
                'description' => 'Delete gallery images',
                'status' => true,
            ],

            // Testimonials
            [
                'name' => 'Testimonials View',
                'slug' => 'testimonials.view',
                'module' => 'testimonials',
                'description' => 'View testimonials',
                'status' => true,
            ],
            [
                'name' => 'Testimonials Create',
                'slug' => 'testimonials.create',
                'module' => 'testimonials',
                'description' => 'Create testimonials',
                'status' => true,
            ],
            [
                'name' => 'Testimonials Edit',
                'slug' => 'testimonials.edit',
                'module' => 'testimonials',
                'description' => 'Edit testimonials',
                'status' => true,
            ],
            [
                'name' => 'Testimonials Delete',
                'slug' => 'testimonials.delete',
                'module' => 'testimonials',
                'description' => 'Delete testimonials',
                'status' => true,
            ],

            // Settings
            [
                'name' => 'Settings View',
                'slug' => 'settings.view',
                'module' => 'settings',
                'description' => 'View settings',
                'status' => true,
            ],
            [
                'name' => 'Settings Edit',
                'slug' => 'settings.edit',
                'module' => 'settings',
                'description' => 'Edit settings',
                'status' => true,
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['slug' => $permission['slug']],
                $permission
            );
        }
    }
}
