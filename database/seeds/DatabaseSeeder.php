<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Friends;
use App\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker::create('pl_PL');
        $number_of_users = 20;
        $comments_per_post = 5;

        DB::table('roles')->insert([
            'id' => 1,
            'name' => 'admin',
        ]);

        DB::table('roles')->insert([
            'id' => 2,
            'name' => 'user',
        ]);

        for ($user_id=1; $user_id <= $number_of_users; $user_id++) {
        	if ($user_id == 1) {

        	    DB::table('users')->insert([
					'name' => 'Bartek Iskrzycki',
					'email' => 'bartek.iskrzycki@gmail.com',
					'sex' => 'm',
                    'role_id' => 1,
					'password' => bcrypt('pass'),
			    ]);

        	} else {
                //========================== USERS ==========================
	        	$sex = $faker->randomElement(['m','f']);

	        	switch ($sex) {
	        		case 'm':
	        			$name = $faker->firstNameMale . ' ' . $faker->lastNameMale;
	        			$avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=male'))->results[0]->picture->large;
	        			break;
	        		case 'f':
	        			$name = $faker->firstNameFemale . ' ' . $faker->lastNameFemale;
	        			$avatar = json_decode(file_get_contents('https://randomuser.me/api/?gender=female'))->results[0]->picture->large;
	        			break;
	        	}

	        	DB::table('users')->insert([
			        'name' => $name,
			        'email' => str_replace('-', '', str_slug($name)) . '@' . $faker->safeEmailDomain(),
			        'sex' => $sex,
                    'role_id' => 2,
			        'avatar' => $avatar,
			        'password' => bcrypt('pass'),
			    ]);
        	}

            //========================== FRIENDS ==========================
        	for($i = 1; $i <= $faker->numberBetween($min = 0, $max = $number_of_users - 1); $i++) {

        		$friend_id = $faker->numberBetween($min = 1, $max = $number_of_users);

        		$condition = Friends::where([
					'user_id' => $user_id,
					'friend_id' => $friend_id,
					])->orWhere([
					'user_id' => $friend_id,
					'friend_id' => $user_id,
				])->exists();

        		if(! $condition) {
        		    DB::table('friends')->insert([
			        'user_id' => $user_id,
			        'friend_id' => $friend_id,
			        'accepted' => 1,
			        'created_at' => $faker->dateTimeThisYear($max = 'now'),
			    	]);
        		}
        	}

        	for($post_iteration = 1; $post_iteration <= $faker->numberBetween($min = 1, $max = 5); $post_iteration++) {
    		    DB::table('posts')->insert([
		        'user_id' => $user_id,
		        'content' => $faker->sentence($nbWords = 3, $variableNbWords = true),
		        'created_at' => $faker->dateTimeThisYear($max = 'now'),
		    	]);
        	}
        }

        $post_number_in_database = Post::all()->count();
        for($post_id = 1; $post_id <= $post_number_in_database; $post_id++) {
            for ($comment_iteration=1; $comment_iteration <= $faker->numberBetween(1, $comments_per_post); $comment_iteration++) {
                DB::table('comments')->insert([
                    'post_id' => $post_id,
                    'user_id' => $faker->numberBetween(1, $number_of_users),
                    'content' => $faker->sentence($nbWords = 5, $variableNbWords = true),
                    'created_at' => $faker->dateTimeThisYear($max = 'now'),
                ]);
            }
        }
    }
}
