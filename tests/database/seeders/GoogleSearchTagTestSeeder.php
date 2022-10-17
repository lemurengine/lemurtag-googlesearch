<?php namespace LemurEngine\GoogleSearch\Tests\Seeder;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleSearchTagTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('category_groups')
            ->updateOrInsert(
                ['slug' => 'unit-google-search-categories', 'user_id' => 1],
                [
                    'language_id' => 1,
                    'is_master' => 1,
                    'name' => 'unit-google-search-categories',
                    'description' => 'For unit testing the google search tag in the temp database - this should not be in live',
                    'created_at' => now()
                ]
            );

        $categoryGroup = DB::table('category_groups')->where('slug', 'unit-google-search-categories')->first();
        $category_group_id = $categoryGroup->id;

        DB::table('categories')->updateOrInsert(
            ['slug' => 'unit-google-search-1', 'user_id' => 1 ,'category_group_id'=>$category_group_id],
            [
                'pattern' => "SEARCH GOOGLE FOR A *",
                'regexp_pattern' => "SEARCH GOOGLE FOR A %",
                'first_letter_pattern' => "S",
                'topic' => "",
                'regexp_topic' => "",
                'first_letter_topic' => "",
                'that' => "",
                'regexp_that' => "",
                'first_letter_that' => "",
                'template' => "<googlesearch><star /></googlesearch>",
                'status' => "A",
                'created_at' => now()
            ]
        );
    }

}



