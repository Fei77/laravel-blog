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
     * 
     * @var array
     */
    protected $users;

    /**
     * Array of tag IDs
     * 
     * @var array
     */
    protected $tags;

    /**
     * Array of images from unsplash
     * 
     * @var array
     */
    protected $images;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->users = \App\User::pluck('id')->all();
        $this->tags = \App\Tag::pluck('id')->all();

        /**
         * fetch random images from unsplash
         */
        $options = [
            'client_id' => env('UNSPLASH_API_KEY'),
            'query' => 'food',
            'per_page' => 30
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.unsplash.com/search/photos?'.http_build_query($options));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        $this->images = json_decode($server_output)->results;
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
        $post = $category->posts()->create([
            'author_id' => array_rand_value($this->users),
            'title' => $this->generateWords(5, 8),
            'content' => $this->generateParagraphsWithImg()
        ]);
        
        $post->save();
        
        $post->tags()->sync(array_rand_value($this->tags, rand(2, 5)));

        $this->generateImage($post, 'images/generated/posts', 'post_thumbnail', $post->title);
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
     * Generate paragraphs with img tag inside it
     * 
     * @return string
     */
    public function generateParagraphsWithImg()
    {
        $string = '';

        foreach(range(1, rand(1,3)) as $i) {
            $string = $string . $this->generateParagraphs();
        }

        $string = $string . $this->generateImgTag();

        foreach(range(1, rand(1,3)) as $i) {
            $string = $string . $this->generateParagraphs();
        }

        return $string;
    }

    /**
     * Generate img tag
     * 
     * @return string
     */
    public function generateImgTag()
    {
        $image = asset(Helpers::image($this->generateRandomImageUrl())->folder('images/generated/posts')->encode('jpg', 90)->save());

        return "<img src='{$image}' />";
    }

    /**
     * Generate random image url from unsplash
     * 
     * @return string
     */
    public function generateRandomImageUrl()
    {
        return array_rand_value($this->images)->urls->regular;
    }

    /**
     * Store image to storage
     * 
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $folder
     * @param string $key
     * @param string $alt
     */
    public function generateImage($model, $folder, $key = '', $alt ='')
    {
        $image = Helpers::image($this->generateRandomImageUrl())->folder($folder)->encode('jpg', 90)->saveWithThumbnail(400, null);

        $model->media()->create([
            'original_filename' => $image['originalName'],
            'preview_filename' => $image['thumbnailName'],
            'mime_type' => 'jpg',
            'key' => $key,
            'alt_text' => $alt
        ]);
    }

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
