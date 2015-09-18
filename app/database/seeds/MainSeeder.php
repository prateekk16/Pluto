<?php






class MainSeeder extends Seeder {

    public function run()
    {
    	// DB::table('users')->delete();
    	// DB::table('statuses')->delete();
    	// DB::table('news_updates')->delete();
    	// DB::table('friend_request_notifications')->delete();
    	// DB::table('messages')->delete();
    	DB::table('global_codes')->delete();

    	// $user = new Pluto\Users\User;
    	// $user->username = 'prateekk16'; 
    	// $user->email = 'prateekk16@gmail.com';
    	// $user->password = Hash::make('assassins');
    	// $user->save();

    	// $userInfo = new Pluto\Users\UserInfo;
    	// $userInfo->user_id = $user->id;
    	// $userInfo->firstname = 'Prateek';
    	// $userInfo->lastname = 'Singh';
    	// $userInfo->gender = 'Male';
    	// $userInfo->image_url = '../img/blank_med.jpg';
    	// $userInfo->save();

     //    $user1 = new User;
     //    $user1->username = 'john'; 
     //    $user1->email = 'john@cliqoid.com';
     //    $user1->password = Hash::make('asdf');
     //    $user1->save();

     //    $userInfo1 = new UserInfo;
     //    $userInfo1->user_id = $user1->id;
     //    $userInfo1->firstname = 'John';
     //    $userInfo1->lastname = 'Doe';
     //    $userInfo1->gender = 'Male';
     //    $userInfo1->image_url = '../img/blank_med.jpg';
     //    $userInfo1->save();

     //    $user2 = new User;
     //    $user2->username = 'jane'; 
     //    $user2->email = 'jane@cliqoid.com';
     //    $user2->password = Hash::make('asdf');
     //    $user2->save();

     //    $userInfo2 = new UserInfo;
     //    $userInfo2->user_id = $user2->id;
     //    $userInfo2->firstname = 'Jane';
     //    $userInfo2->lastname = 'Doe';
     //    $userInfo2->gender = 'Female';
     //    $userInfo2->image_url = '../img/blank_med.jpg';
     //    $userInfo2->save();

        // SET UP GLOBAL CODES

    	$global = new GlobalCode;
    	$global->type = 'global';
    	$global->code = '1';
    	$global->save();

    	$friends = new GlobalCode;
    	$friends->type = 'friends';
    	$friends->code = '2';
    	$friends->save();

    	$group = new GlobalCode;
    	$group->type = 'group';
    	$group->code = '3';
    	$group->save();



    }
}