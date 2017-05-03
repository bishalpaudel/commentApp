<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 5/2/17
 * Time: 2:30 PM
 */

namespace App\Seeder;


use App\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Comment::class, 5)->create();
    }
}