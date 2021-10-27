<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Area;
use App\Models\Category;
use App\Models\Cycle;
use App\Models\Group;
use App\Models\Qualification;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Module;
use App\Models\Request;
use App\Models\Subject;
=======
use App\Models\Activity;
use App\Models\Area;
use App\Models\Category;
use App\Models\Cycle;
use App\Models\Document;
use App\Models\Group;
use App\Models\Module;
use App\Models\Qualification;
use App\Models\Request;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use assignments;
>>>>>>> bebf3f2d8dbcde4de2938dc6ecdf0f5a94b797bb
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
        // \App\Models\User::factory(10)->create();
    Cycle::factory(10)->create();
    Group::factory(20)->create();
    Category::factory(20)->create();
    Student::factory(20)->create();
    Area::factory(5)->create();
    Teacher::factory(20)->create();
    Qualification::factory(20)->create();
    Activity::factory(20)->create();
    Document::factory(20)->create();
    Module::factory(20)->create();
    Request::factory(20)->create();
    Subject::factory(20)->create();
<<<<<<< HEAD
=======
    assignments::factory(30)->create();
>>>>>>> bebf3f2d8dbcde4de2938dc6ecdf0f5a94b797bb
    }

}
