<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\MemberArisan;
use Illuminate\Console\Command;

class RemindMembers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setoran:remind-members';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders to members who haven\'t made deposits';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = MemberArisan::where('status_setoran', '=', 'Sudah Setor')->get();
        // $members = MemberArisan::all();

        $this->info('Number of members: ' . count($members));

        foreach ($members as $member) {
            $this->info('Processing member: ' . $member->id_user);
            $memberInterval = $member->arisan->deposit_frequency;

            // Tentukan apakah sudah saatnya mengirimkan pengingat berdasarkan interval
            // if ($this->shouldRemind(1, $member->updated_at)) {
            // if ($this->shouldRemind(1, $member->updated_at)) {
            // TODO: Kode untuk mengirimkan pengingat ke anggota yang belum setor
            $this->info('Reminder sent to member: ' . $member->id_user);
            $member->update([
                'status_setoran' => 'Belum Setor'
            ]);
            // }
        }

        $this->info('Handle method completed');
    }

    private function shouldRemind($interval, $lastUpdated)
    {
        $today = Carbon::today();
        $interval = intval($interval);

        if ($interval == 1) {
            // Setoran setiap 1 minggu
            return $today->diffInWeeks($lastUpdated) >= 1;
        } elseif ($interval == 2) {
            // Setoran setiap 2 minggu
            return $today->diffInWeeks($lastUpdated) >= 2;
        } elseif ($interval == 4) {
            // Setoran setiap 1 bulan
            return $today->diffInMonths($lastUpdated) >= 1;
        }

        return false;
    }
}
