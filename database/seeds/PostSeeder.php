<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Faker
     */
    protected $faker;

    /**
     * Array of user IDs
     */
    protected $users;

    /**
     * Array of tag IDs
     */
    protected $tags;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->users = \App\User::pluck('id')->all();
        $this->tags = \App\Tag::pluck('id')->all();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTable();

        foreach(range(1, 5) as $i) {
            $this->command->info("Creating category #{$i}");
            $this->createCategory();
        }
    }

    /**
     * Create category
     * 
     * @return void
     */
    public function createCategory()
    {
        $category = \App\Category::create([
            'name' => $this->generateWords(1, 3),
            'title' => $this->generateWords(5, 8)
        ]);

        foreach(range(1, 5) as $i) {
            $this->command->info("Creating category {$category->name} post #{$i}");
            $this->createPost($category);
        }
    }

    /**
     * Create post
     * 
     * @param \App\Category $category
     * @return void
     */
    public function createPost($category)
    {
        $category->posts()->create([
            'author_id' => array_rand_value($this->users),
            'title' => $this->generateWords(5, 8),
            'content' => $this->generateParagraphs()
        ])->tags()->sync(array_rand_value($this->tags, rand(2, 5)));
    }

    /**
     * Generate random words
     * 
     * @param integer $start
     * @param integer $end
     * @return string
     */
    public function generateWords($start = 1, $end = 2)
    {
        return ucfirst($this->faker->words(rand($start, $end), true));
    }

    /**
     * Generate paragraph from random string
     * 
     * @return string
     */
    public function generateParagraphs()
    {
        return "<p>{$this->faker->sentences(rand(3,4), true)}</p>";
    }

    /**
     * Gene
     */

    public function truncateTable()
    {
        $this->command->info('Truncating category table');
        Schema::disableForeignKeyConstraints();
        \App\Category::truncate();
        \App\Post::truncate();
        DB::table('taggables')->where('taggable_type', 'App\Post')->delete();
        Schema::enableForeignKeyConstraints();
    }
}
