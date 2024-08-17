<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');

        $password = $this->secret('Type Password');
        $confirmPassword = $this->secret('Confirm Password');

        if ($password !== $confirmPassword) {
            $this->error('Passwords do not match.');
            return 1; 
        }

        $validator = Validator::make([
            'email' => $email,
            'password' => $password
        ], [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            $this->error('Validation failed: ' . $validator->errors()->first());
            return 1; // Indicate error
        }

        User::create([
            'email' => $email,
            'name' => $name,
            'role' => 'admin',
            'password' => Hash::make($password)
        ]);

        $this->info('User is successfully created.');
        return 0; 
    }
}
