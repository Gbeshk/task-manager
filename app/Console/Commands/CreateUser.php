<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUser extends Command
{
	protected $signature = 'user:create {email} {password}';

	protected $description = 'Create a new user with email and password';

	public function handle(): void
	{
		$email = $this->argument('email');
		$password = $this->argument('password');

		$validator = Validator::make([
			'email'    => $email,
			'password' => $password,
		], [
			'email'    => ['required', 'email', 'unique:users,email'],
			'password' => ['required', 'min:4'],
		]);

		if ($validator->fails()) {
			foreach ($validator->errors()->all() as $error) {
				$this->error($error);
			}

			return;
		}

		$user = User::create([
			'name'     => explode('@', $email)[0],
			'email'    => $email,
			'password' => Hash::make($password),
		]);

		$this->info('User created successfully!');
		$this->table(
			['ID', 'Name', 'Email', 'Created At'],
			[[$user->id, $user->name, $user->email, $user->created_at]]
		);
	}
}
