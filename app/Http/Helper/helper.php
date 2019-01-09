<?php
    function getFollowingIds(){
        $following = \App\Following::where('userId',Auth::user()->id)->get();

        if(count($following)==0) $ids[] = 0;
        else{
            foreach ($following as $f) {
                $ids[] = $f->followingId;
            }
        }

        return $ids;
    }
?>