<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Key;

class GenerateKeyQRCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'keys:generate-qr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate QR codes for all keys and save them in public/qrcodes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $outputDir = public_path('qrcodes');

        // Ensure the folder exists
        if (!File::exists($outputDir)) {
            File::makeDirectory($outputDir, 0755, true);
            $this->info("Created directory: {$outputDir}");
        }

        $keys = Key::all();

        if ($keys->isEmpty()) {
            $this->warn('No keys found in the database.');
            return Command::SUCCESS;
        }

        foreach ($keys as $key) {
            $filename = $key->code . '.png';
            $filePath = $outputDir . DIRECTORY_SEPARATOR . $filename;

            // Generate QR code with the key’s unique identifier or URL
            QrCode::format('png')
                ->size(250)
                ->margin(2)
                ->generate($key->uuid ?? $key->code, $filePath);

            $this->info("✅ QR code created for key: {$key->label} → {$filename}");
        }

        $this->info('🎉 All QR codes have been successfully generated!');
        return Command::SUCCESS;
    }
}