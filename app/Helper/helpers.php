<?php

  namespace App\Helper;
  
  class Helper
  {
    // /**
    //  * assetの処理に加えて、ランダムな値をクエリストリングとして付加する。
    //  *
    //  * @param
    //  *
    //  * @return
    //  */
    public static function createRWord($User_words)
    {
      $word_count = $User_words->count();
      $rand = rand(0, $word_count-1);
      return $User_words[$rand];
    }
  }
