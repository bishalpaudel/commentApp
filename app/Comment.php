<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    protected $table = 'comments';

    public function comments(){
        return $this->hasMany("App\Comment")->with("comments");
    }

    public function hasDepthLessThan(int $depth): bool{
        $query = DB::table($this->table . " as parent0");
        for($i = 1; $i <= $depth; $i++){
            $query->join($this->table . " as parent".$i, 'parent'.($i-1).'.comment_id', '=', 'parent'.$i.'.id');
        }
        $result = $query->select('parent'.$depth.'.id')
            ->where('parent0.id', "=", $this->id)
            ->get();
        return count($result) === 0;
    }

    public function setComment(String $comment){
        $this->comment = $comment;
    }

    public function setAuthor(String $author){
        $this->author = $author;
    }

    public function setParent(Comment $parent){
        $this->comment_id = $parent != null ? $parent->id : null;
    }


//    public function queryWithLevels(){
//        select root.id  as root
//          , down1.id as down1
//          , down2.id as down2
//          , down3.id as down3
//        from comments as root
//          left outer
//          join comments as down1
//            on down1.comment_id = root.id
//          left outer
//          join comments as down2
//            on down2.comment_id = down1.id
//          left outer
//          join comments as down3
//            on down3.comment_id = down2.id
//        where root.comment_id is null
//        order by root, down1, down2, down3
//    }
}
