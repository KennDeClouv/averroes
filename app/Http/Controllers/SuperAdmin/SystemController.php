<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SystemController extends Controller
{

    public function index()
    {
        return view('roles.SuperAdmin.system.index');
    }

    public function runCLI(Request $request)
    {
        // validasi input
        $validated = $request->validate([
            'command' => 'required|string',
        ]);

        // jalankan command cli
        try {
            if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
                $process = Process::fromShellCommandline($validated['command']);
                $process->setTty(true); // Enable TTY mode untuk non-Windows
            } else {
                $process = Process::fromShellCommandline("C:\\Windows\\System32\\cmd.exe /c " . $validated['command']); // Untuk Windows
            }

            $process->run();

            // jika gagal, lempar error
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return response()->json(['output' => $process->getOutput()]);
        } catch (ProcessFailedException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getMacAddress()
    {
        // menjalankan perintah getmac
        $process = new Process(['ipconfig', '/all']);
        $process->run();

        if ($process->isSuccessful()) {
            $output = $process->getOutput();
            // cari MAC address dalam output
            if (preg_match('/(?:Physical|Ethernet) Address[ :]+([0-9A-Fa-f-]+)/', $output, $matches)) {
                $process = new Process(['getmac']);
            }
        }

        return 'MAC address tidak ditemukan';
    }
}
