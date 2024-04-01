<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DoorIp;

class CheckDoorsStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-doors-states';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $door_ips= DoorIp::select('*')
                        ->whereNot('door_ip_status', 'Inactive')
                         ->get();
    foreach  ($door_ips as $door_ip)
    {
    //dd($door_ip['ip_address']);
        // $ip = '127.0.0.1';
        // $port = '22';
        // $url = $ip . ':' . $port;
        $url= $door_ip['ip_address'];
        //$url = '172.16.59.117';
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($health) {
                if($door_ip['door_ip_status']==='Offline'){
                DoorIp::where('id',$door_ip['id'])
                        ->update([
                            'door_ip_status' => 'Online']);
               // $json = json_encode(['health' => $health, 'status' => '1']);
            // return $json;
            }}
            else {
                if($door_ip['door_ip_status']==='Online'){

                    DoorIp::where('id',$door_ip['id'])
                    ->update([
                        'door_ip_status' => 'Offline']);
                  //  $json = json_encode(['health' => $health, 'status' => '0']);
            // return $json;
            }
            }
        }
      // return 'done';
       $this->info('done');

        }
    }


