<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for ($i = 0; $i < 3; $i++) { 
           $new_posts = new Post();

           $new_posts->title = 'Post Title' . ($i + 1);
           $new_posts->slug = Str::slug($new_posts->title, '-');
           $new_posts->content = 'Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip. Lorem ipsum dolor sit amet, consectetur adip';
           $new_posts->save();
       }
    }
}
