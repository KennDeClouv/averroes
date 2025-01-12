<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class PerformanceController extends Controller
{
    public function index()
    {
        $cpuUsage = $this->getCpuUsage();
        $memoryUsage = $this->getMemoryUsage();
        $diskUsage = $this->getDiskUsage();
        $systemInfo = $this->getSystemInfo();

        // Get Database Performance (query log)
        DB::enableQueryLog();
        DB::table('users')->get(); // Example query to generate log
        $queryLog = DB::getQueryLog();

        // Active Sessions
        $activeUsers = DB::table('sessions')->count();

        // Queue Jobs
        $jobsPending = DB::table('jobs')->count();

        // Compile all data
        $performanceData = [
            'cpuUsage' => $cpuUsage,
            'memoryUsage' => $memoryUsage,
            'diskUsage' => $diskUsage,
            'queryLog' => $queryLog,
            'activeUsers' => $activeUsers,
            'jobsPending' => $jobsPending,
            'systemInfo' => $systemInfo,
        ];

        return view('roles.SuperAdmin.performance.index', compact('performanceData'));
    }

    private function getCpuUsage()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Command untuk Windows
            $cmd = 'wmic cpu get loadpercentage';
            @exec($cmd, $output);
            return isset($output[1]) ? (int) trim($output[1]) : null;
        } else {
            // Command untuk Linux
            $cpuLoad = sys_getloadavg();
            $cpuCores = function_exists('proc_open') ? $this->getCpuCoreCount() : 1; // Default ke 1 jika gagal
            $cpuUsage = ($cpuLoad[0] / $cpuCores) * 100;
            return round($cpuUsage, 2);
        }
    }

    private function getCpuCoreCount()
    {
        if (function_exists('proc_open')) {
            $process = proc_open('nproc', [
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w']
            ], $pipes);

            if (is_resource($process)) {
                $output = stream_get_contents($pipes[1]);
                fclose($pipes[1]);
                fclose($pipes[2]);
                proc_close($process);

                return intval(trim($output));
            }
        }
        return 1; // Default ke 1 jika gagal
    }

    private function getMemoryUsage()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Command untuk Windows
            $cmd = 'wmic os get freephysicalmemory, totalvisiblememorysize /value';
            @exec($cmd, $output);
            $memoryData = [];
            foreach ($output as $line) {
                if (strpos($line, '=') !== false) {
                    [$key, $value] = explode('=', $line);
                    $memoryData[trim($key)] = trim($value);
                }
            }

            $totalMemory = isset($memoryData['TotalVisibleMemorySize']) ? $memoryData['TotalVisibleMemorySize'] * 1024 : 0;
            $freeMemory = isset($memoryData['FreePhysicalMemory']) ? $memoryData['FreePhysicalMemory'] * 1024 : 0;
            $usedMemory = $totalMemory - $freeMemory;

            return $totalMemory > 0 ? round(($usedMemory / $totalMemory) * 100, 2) : null;
        } else {
            // Command untuk Linux
            if (is_readable('/proc/meminfo')) {
                $memInfo = file('/proc/meminfo');
                $totalMemory = (int) filter_var($memInfo[0], FILTER_SANITIZE_NUMBER_INT);
                $freeMemory = (int) filter_var($memInfo[1], FILTER_SANITIZE_NUMBER_INT);
                $usedMemory = $totalMemory - $freeMemory;

                return round(($usedMemory / $totalMemory) * 100, 2);
            }
        }

        return null; // Jika tidak bisa membaca data
    }

    private function getDiskUsage()
    {
        $totalSpace = disk_total_space('/');
        $freeSpace = disk_free_space('/');
        $usedSpace = $totalSpace - $freeSpace;

        return $totalSpace > 0 ? round(($usedSpace / $totalSpace) * 100, 2) : null;
    }
    public function getSystemInfo()
    {
        $info = [];

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Get system info for Windows
            $info = array_merge($info, $this->getSystemInfoWindows());
        } else {
            // Get system info for Linux
            $info = array_merge($info, $this->getSystemInfoLinux());
        }

        return $info;
    }

    private function getSystemInfoWindows()
    {
        $info = [];

        // Get CPU Name
        @exec('wmic cpu get name', $cpuOutput);
        $info['cpu'] = isset($cpuOutput[1]) ? trim($cpuOutput[1]) : 'Unknown CPU';

        // Get RAM Size, Manufacturer, and Speed
        @exec('wmic memorychip get capacity, manufacturer, speed', $ramOutput);
        $totalMemory = 0;
        $ramDetails = [];
        if (!empty($ramOutput)) {
            foreach ($ramOutput as $line) {
                if (preg_match('/\d+/', trim($line), $matches)) {
                    $ramDetails[] = $matches[0];
                }
            }
        }

        // Extract total memory and details
        $totalMemory = array_sum($ramDetails);
        $info['memory'] = $totalMemory > 0
            ? round($totalMemory / (1024 ** 3), 2) . ' GB ' . $this->getMemoryDetails($ramOutput)
            : 'Unknown RAM';

        return $info;
    }

    private function getSystemInfoLinux()
    {
        $info = [];

        // Get CPU Name
        if (is_readable('/proc/cpuinfo')) {
            $cpuInfo = file('/proc/cpuinfo');
            foreach ($cpuInfo as $line) {
                if (strpos($line, 'model name') === 0) {
                    $info['cpu'] = trim(explode(':', $line)[1]);
                    break;
                }
            }
        } else {
            $info['cpu'] = 'Unknown CPU';
        }

        // Get RAM Size and Type
        if (is_readable('/proc/meminfo')) {
            $memInfo = file('/proc/meminfo');
            $totalMemory = (int) filter_var($memInfo[0], FILTER_SANITIZE_NUMBER_INT); // Total memory in KB
            $info['memory'] = round($totalMemory / 1024 / 1024, 2) . ' GB ' . $this->getMemoryTypeLinux(); // Convert to GB
        } else {
            $info['memory'] = 'Unknown RAM';
        }

        return $info;
    }

    private function getMemoryTypeWindows()
    {
        $memoryTypes = [
            0 => ' ',
            1 => 'Other',
            2 => 'DRAM',
            3 => 'Synchronous DRAM',
            4 => 'Cache DRAM',
            5 => 'EDO',
            6 => 'EDRAM',
            7 => 'VRAM',
            8 => 'SRAM',
            9 => 'RAM',
            10 => 'ROM',
            11 => 'Flash',
            12 => 'EEPROM',
            13 => 'FEPROM',
            14 => 'EPROM',
            15 => 'CDRAM',
            16 => '3DRAM',
            17 => 'SDRAM',
            18 => 'SGRAM',
            19 => 'RDRAM',
            20 => 'DDR',
            21 => 'DDR2',
            22 => 'DDR2 FB-DIMM',
            24 => 'DDR3',
            26 => 'DDR4',
            27 => 'LPDDR4',
            28 => 'LPDDR5',
            29 => 'DDR5'
        ];

        @exec('wmic memorychip get memorytype', $output);
        $type = isset($output[1]) ? (int) trim($output[1]) : 0;

        return $memoryTypes[$type] ?? ' ';
    }

    private function getMemoryDetails($output)
    {
        $details = '';
        // Get Memory Manufacturer and Speed
        @exec('wmic memorychip get manufacturer, speed', $outputDetails);
        if (isset($outputDetails[1])) {
            $details .= ' ' . trim($outputDetails[1]); // Manufacturer
            $details .= ' ' . trim($outputDetails[2]) . ' MHz'; // Speed
        }

        return $details;
    }

    private function getMemoryTypeLinux()
    {
        $process = proc_open(
            "sudo dmidecode --type memory | grep -m1 'Type:'",
            [
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"], // stderr
            ],
            $pipes
        );

        if (is_resource($process)) {
            $output = stream_get_contents($pipes[1]);
            fclose($pipes[1]);
            fclose($pipes[2]);

            $returnCode = proc_close($process);

            if ($output) {
                $line = trim($output);
                return str_replace('Type:', '', $line);
            }
        }
        return ' ';
    }
}
