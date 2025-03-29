<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\users;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;



class generateQrCode implements ShouldQueue
{
use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

protected $user;

public function __construct(users $user)
{
    $this->user = $user;
}

public function handle()
{
   // Generate the QR code 
    $qrCode = QrCode::format('png')->size(200)->generate($this->user->address);
    // Save the QR code as an image file
    $file = $qrCode; //"data:image/png;base64,' . base64_encode($qrCode) . '";
    $safeName = 'user_' . $this->user->id . '.png';
    $success = file_put_contents(public_path().'/storage/qrcodes/'.$safeName, $file);
   $this->user->qr_code_path = 'public/storage/qrcodes/'.$safeName;
   $this->user->save();
 }
    
 }
