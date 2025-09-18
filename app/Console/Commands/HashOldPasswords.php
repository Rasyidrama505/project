<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashOldPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:hash-old-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert old plain text passwords in users table into bcrypt hashed passwords';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = DB::table('users')->get();
        $updatedCount = 0;

        foreach ($users as $user) {
            // cek apakah password belum di-hash (bcrypt biasanya diawali dengan $2y$)
            if (substr($user->password, 0, 4) !== '$2y$') {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($user->password)]);
                $updatedCount++;
            }
        }

        $this->info("Selesai! Total password yang di-hash ulang: {$updatedCount}");
    }
}
