use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EncryptUserPasswordsSeeder extends Seeder
{
    public function run()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            if (!Hash::needsRehash($user->password)) {
                continue;
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'password' => Hash::make($user->password)
                ]);
        }

        echo "Semua password berhasil dienkripsi.\n";
    }
}
