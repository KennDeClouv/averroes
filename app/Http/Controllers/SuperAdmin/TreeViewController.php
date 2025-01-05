<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TreeViewController extends Controller
{
    public function index()
    {
        // Define folder path yang ingin discan
        $folderPath = base_path('/');
        $treeData = $this->generateJsTreeData($folderPath);
        $jsTreeData = json_encode($treeData, JSON_PRETTY_PRINT);
        return view('roles.SuperAdmin.folder_tree.index', compact('jsTreeData'));
    }

    private function generateJsTreeData($path)
    {
        $result = [];
        $files = array_diff(scandir($path), ['.', '..']);

        foreach ($files as $file) {
            $fullPath = $path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($fullPath)) {
                // Check if the folder is named "database"
                $type = match ($file) {
                    'database' => 'database',
                    'config','Controllers','Providers' => 'config',
                    'app' =>'app',
                    default => 'folder',
                };

                $result[] = [
                    'text' => $file,
                    'type' => $type,
                    'state' => ['opened' => false],
                    'children' => $this->generateJsTreeData($fullPath),
                ];
            } else {
                // Determine type based on file extension
                $type = match (true) {
                    str_ends_with($file, '.blade.php') || str_ends_with($file, 'artisan') => 'blade',
                    str_ends_with($file, '.html') => 'html',
                    str_ends_with($file, '.css') => 'css',
                    str_ends_with($file, '.js') => 'js',
                    str_ends_with($file, '.php') => 'php',
                    str_ends_with($file, '.md') => 'md',
                    str_ends_with($file, '.json') => 'json',
                    str_ends_with($file, '.git') || str_ends_with($file, '.gitignore') || str_ends_with($file, '.gitattributes') => 'git',
                    str_ends_with($file, '.jpg') || str_ends_with($file, '.png') || str_ends_with($file, '.jpeg') || str_ends_with($file, '.gif') || str_ends_with($file, '.svg') => 'img',
                    default => 'file',
                };

                $result[] = [
                    'text' => $file,
                    'type' => $type,
                ];
            }
        }

        return $result;
    }
}
