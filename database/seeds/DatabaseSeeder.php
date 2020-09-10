<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('database.default') !== 'sqlite') {
        	DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }

        /* 아티클 태그 */
        App\Tag::truncate();
        DB::table('article_tag')->truncate();
        $tags = config('project.tags');

        foreach($tags as $slug => $name) {
            App\Tag::create([
                'name' => $name,
                'slug' => str_slug($slug)
            ]);
        }
        $this->command->info('Seeded: tags table');

        /* 갤러리 태그 */
        App\Gtag::truncate();
        DB::table('gallery_gtag')->truncate();
        $gtags = config('project.gtags');

        foreach($gtags as $slug => $name) {
            App\Gtag::create([
                'name' => $name,
                'slug' => str_slug($slug)
            ]);
        }
        $this->command->info('Seeded: gtags table');

        /* 변수 선언 */
        $faker = app(Faker\Generator::class);
        $users = App\User::all();
        $articles = App\Article::all();
        $galleries = App\Gallery::all();
        $tags = App\Tag::all();
        $gtags=App\Gtag::all();

        /* 아티클과 태그 연결 */
        foreach ($articles as $article) {
            $article->tags()->sync(
                $faker->randomElements(
                    $tags->pluck('id')->toArray(), rand(1, 3)
                )
            );
        }

        $this->command->info('Seeded: article_tag table');

        /* 갤러리와 태그 연결 */
        foreach ($galleries as $gallery) {

            $gallery->gtags()->sync(
                $faker->randomElements(
                    $gtags->pluck('id')->toArray(), rand(1, 3)
                )
            );
        }
        $this->command->info('Seeded: gallery_tag table');
//		Model::unguard();

        App\User::truncate();
        $this->call(UsersTableSeeder::class);

        App\Article::truncate();
        $this->call(ArticlesTableSeeder::class);

        App\Gallery::truncate();
        $this->call(GalleriesTableSeeder::class);

//		Model::reguard();

        App\Attachment::truncate();
        if (! File::isDirectory(attachments_path())) {
            File::makeDirectory(attachments_path(), 775, true);
        }
        File::cleanDirectory(attachments_path());


        $this->command->error('Downloading images from lorempixel. It takes time...');

        $articles->each(function ($article) use ($faker) {
            $path = $faker->image(attachments_path());
            $filename = File::basename($path);
            $bytes = File::size($path);
            $mime = File::mimeType($path);
            $this->command->warn("File saved: {$filename}");

            $article->attachments()->save(
                factory(App\Attachment::class)->make(compact('filename', 'bytes', 'mime')));
        });
        $this->command->info('Seeded: attachments table and files');

       


        if (config('database.default') !== 'sqlite') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
        //최상위 댓글
        $articles->each(function ($article) {
            $article->comments()->save(factory(App\Comment::class)->make());
            $article->comments()->save(factory(App\Comment::class)->make());
        });

        //자식 댓글
        $articles->each(function ($article) use ($faker) {
            $commentIds = App\Comment::pluck('id')->toArray();

            foreach(range(1,5) as $index) {
                $article->comments()->save(
                    factory(App\Comment::class)->make([
                        'parent_id' => $faker->randomElement($commentIds),
                    ])
                );
            }
        });

        $this->command->info('Seeded:comments table');

        //갤러리 댓글
        //최상위 댓글
        $galleries->each(function ($gallery) {
            $gallery->gcomments()->save(factory(App\Gcomment::class)->make());
            $gallery->gcomments()->save(factory(App\Gcomment::class)->make());
        });

        //자식 댓글
        $galleries->each(function ($gallery) use ($faker) {
            $gcommentIds = App\Gcomment::pluck('id')->toArray();

            foreach(range(1,5) as $index) {
                $gallery->gcomments()->save(
                    factory(App\Gcomment::class)->make([
                        'parent_id' => $faker->randomElement($gcommentIds),
                    ])
                );
            }
        });

        $this->command->info('Seeded:gcomments table');


        foreach(range(1, 10) as $index) {
            $path = $faker->image(attachments_path());
            $filename = File::basename($path);
            $bytes = File::size($path);
            $mime = File::mimeType($path);
            $this->command->warn("File saved: {$filename}");

            factory(App\Attachment::class)->create([
                'filename' => $filename,
                'bytes' => $bytes,
                'mime' => $mime,
                'created_at' => $faker->dateTimeBetween('-1 months'),
            ]);
        }
        
    }  
}
