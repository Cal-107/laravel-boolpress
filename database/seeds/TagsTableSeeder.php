<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // App Tags
        $tags = ['Front End', 'Design', 'UX', 'UI', 'Back End', 'Laravel'];

        foreach ($tags as $tag) {
            $new_tag = new Tag();

            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($tag, '-');

            $new_tag->save();
        }
    }
}
