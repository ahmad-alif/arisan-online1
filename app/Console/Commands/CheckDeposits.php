<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Arisan;
use App\Models\CekSetoran;
use App\Models\MemberArisan;
use Illuminate\Console\Command;

class CheckDeposits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:check-deposits';
    // protected $signature = 'check:deposits';

    // protected $description = 'Check deposits for arisans';

    public $queue = 'default';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    protected $signature = 'setoran:check-status';
    protected $description = 'Check and update setoran status';

    public function handle()
    {
        $arisans = Arisan::where('status', '=', 1)->get();

        foreach ($arisans as $arisan) {
            $interval = $arisan->deposit_frequency;

            $members = MemberArisan::where('status_setoran', '=', 'Belum Setor')->get();

            foreach ($members as $member) {
                $interval = $member->arisan->deposit_frequency;

                // Tentukan apakah sudah saatnya melakukan setoran berdasarkan interval
                if ($this->shouldRemind(1, $member->updated_at)) {
                    // MemberArisan::updateOrCreate(
                    //     // ['uuid' => $member->uuid, 'id_user' => $member->id_user],
                    //     ['deposit_status' => 'Belum Setor']
                    // );
                    $member->update([
                        'deposit_status' => 'Belum Setor'
                    ]);
                }
            }
        }
        // return $reminders;
    }

    private function shouldRemind($interval, $lastUpdated)
    {
        $today = Carbon::today();

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

    // public function shouldRemind($startDate)
    // {
    //     $today = Carbon::today();
    //     $startDate = Carbon::parse($startDate);

    //     // Ubah interval menjadi cek setiap hari
    //     return $today->diffInDays($startDate) >= 1;
    // }

    // private function shouldRemind($interval, $startDate)
    // {
    //     $today = Carbon::today();

    //     if ($interval == 1) {
    //         // Setoran setiap 1 minggu
    //         return $today->diffInWeeks($startDate) >= 1;
    //     } elseif ($interval == 2) {
    //         // Setoran setiap 2 minggu
    //         return $today->diffInWeeks($startDate) >= 2;
    //     } elseif ($interval == 4) {
    //         // Setoran setiap 1 bulan
    //         return $today->diffInMonths($startDate) >= 1;
    //     }

    //     return false;
    // }
    // public function handle()
    // {
    //     $arisans = Arisan::where('status', 1)->get();

    //     foreach ($arisans as $arisan) {
    //         // Ambil data setoran untuk arisan dan user tertentu
    //         $user = User::find($arisan->id_user);

    //         if ($user) {
    //             $cekSetoran = CekSetoran::where('uuid', $arisan->uuid)
    //                 ->where('id_user', $user->id)
    //                 ->first();

    //             if ($cekSetoran && $this->isDepositTime($arisan, $cekSetoran)) {
    //                 // Your logic here
    //             }
    //         }

    //         // Cek apakah sudah waktunya melakukan setoran
    //         if ($cekSetoran && $this->isDepositTime($arisan, $cekSetoran)) {
    //             // Lakukan tindakan sesuai kebutuhan, misalnya mengirim notifikasi
    //             $this->info("Waktunya melakukan setoran untuk arisan '{$arisan->nama_arisan}'.");

    //             // Ubah status setoran menjadi sudah dilakukan
    //             $cekSetoran->update(['deposit_status' => 'Sudah dilakukan']);
    //         }
    //     }

    //     $this->info('Deposits checked successfully.');
    // }

    // public function handle()
    // {
    //     $arisans = Arisan::where('status', 1)->get();

    //     foreach ($arisans as $arisan) {
    //         $cekSetoran = CekSetoran::where('uuid', $arisan->uuid)
    //             ->where('id_user', auth()->user()->id)
    //             ->first();

    //         if ($cekSetoran && $this->isDepositTime($arisan, $cekSetoran)) {
    //             $this->info("Arisan '{$arisan->nama_arisan}' belum setoran.");
    //         } else {
    //             $this->info("Setoran arisan '{$arisan->nama_arisan}' sudah dilakukan.");
    //         }
    //     }

    //     $this->info('Deposits checked successfully.');
    // }

    // private function isDepositTime(Arisan $arisan, CekSetoran $cekSetoran)
    // {
    //     $deadline = $cekSetoran->created_at;

    //     if ($arisan->deposit_frequency == 1 || $arisan->deposit_frequency == 2) {
    //         // Jika deposit_frequency adalah 1 atau 2, gunakan addWeeks
    //         $deadline->addWeeks($arisan->deposit_frequency);
    //     } elseif ($arisan->deposit_frequency == 4) {
    //         // Jika deposit_frequency adalah 4, gunakan addMonths
    //         $deadline->addMonths($arisan->deposit_frequency);

    //         // Set tanggal akhir sama dengan tanggal mulai
    //         $deadline->day($cekSetoran->created_at->day);
    //     }

    //     return now()->gte($deadline);
    // }
    private function isDepositTime(Arisan $arisan, CekSetoran $cekSetoran)
    {
        $frequencyUnit = $arisan->deposit_frequency == 4 ? 'month' : 'week';
        $deadline = $cekSetoran->created_at->add($arisan->deposit_frequency, $frequencyUnit);

        return now()->gte($deadline);
    }
}
