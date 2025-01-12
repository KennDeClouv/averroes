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
        ];

        return view('roles.SuperAdmin.performance.index', compact('performanceData'));
    }

    private function getCpuUsage()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // command untuk windows
            $cmd = 'wmic cpu get loadpercentage';
            exec($cmd, $output);
            return isset($output[1]) ? trim($output[1]) : null;
        } else {
            // command untuk linux
            $cpuLoad = sys_getloadavg();
            $cpuCores = shell_exec("nproc"); // Get number of CPU cores
            $cpuUsage = ($cpuLoad[0] / $cpuCores) * 100; // Calculate percentage
            return round($cpuUsage, 2); // Return percentage
        }
    }

    private function getMemoryUsage()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // command untuk windows
            $cmd = 'wmic os get freephysicalmemory, totalvisiblememorysize /value';
            exec($cmd, $output);
            $memoryData = [];
            foreach ($output as $line) {
                if (strpos($line, '=') !== false) {
                    list($key, $value) = explode('=', $line);
                    $memoryData[trim($key)] = trim($value);
                }
            }

            $totalMemory = isset($memoryData['TotalVisibleMemorySize']) ? $memoryData['TotalVisibleMemorySize'] * 1024 : 0;
            $freeMemory = isset($memoryData['FreePhysicalMemory']) ? $memoryData['FreePhysicalMemory'] * 1024 : 0;
            $usedMemory = $totalMemory - $freeMemory;

            // Calculate memory usage in percentage
            $memoryUsage = ($usedMemory / $totalMemory) * 100;

            return round($memoryUsage, 2); // Return percentage
        } else {
            // command untuk linux
            $totalMemory = shell_exec("free -m | awk 'NR==2{print $2}'"); // Total memory in MB
            $freeMemory = shell_exec("free -m | awk 'NR==2{print $3}'"); // Free memory in MB
            $usedMemory = $totalMemory - $freeMemory;

            // Calculate memory usage in percentage
            $memoryUsage = ($usedMemory / $totalMemory) * 100;

            return round($memoryUsage, 2); // Return percentage
        }
    }

    private function getDiskUsage()
    {
        // Disk usage in percentage
        return round(disk_free_space('/') / disk_total_space('/') * 100, 2);
    }
}