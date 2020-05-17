<?php

  namespace App\Helper;

  use App\User;
  use App\Word;
  use App\Like;

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

    public static function favoSwitch(User $currentUser,$request, string $type, string $id) {
      if ($request->$type === 'remove') {
          $like = Like::Search($currentUser->$id, $request->$id);
          $like->delete();
      } elseif ($request->$type === 'add') {
          $like = new Like();
          $like->user_id = $currentUser->$id;
          $like->word_id = $request->$id;
          $like->save();
      } else {
          header("Content-Type: application/json; charset=UTF-8");
          $data = [
          'failedMsg' => 'お気に入り登録or解除に失敗しました'
          ];
          echo json_encode($data);
          exit;
      }

      // try {
      //   if ($request->$type === 'remove') {
      //     $like = Like::Search($currentUser->$id, $request->$id);
      //     $like->delete();
      //   } elseif ($request->$type === 'add') {
      //       $like = new Like();
      //       $like->user_id = $currentUser->$id;
      //       $like->word_id = $request->$id;
      //       $like->save();
      //   } else {
      //       throw new Exception('お気に入り登録or解除に失敗しました');
      //   }
      // } catch (Exception $e){
      //   echo "例外キャッチ：",$e->getMessage();
      //   exit;
      // }
    }

  }
