<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogAktivitas;

class BackupRestoreController extends Controller
{
    public function index()
    {
        return view('backup-restore.index');
    }

    public function backup()
    {
        set_time_limit(0);

        $db = config('database.connections.mysql');
        $filename = 'backup_' . date('Ymd_His') . '.sql';

        $path = storage_path('app/backup');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $mysqldump = 'D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysqldump.exe';

        $command = "\"$mysqldump\" -u{$db['username']} {$db['database']} > \"$path\\$filename\"";
        exec($command);

        LogAktivitas::add(
            'BACKUP_DATABASE',
            'Membuat backup database: ' . $filename,
            'backup_restore',
            null
        );

        return back()->with('success', 'Backup database berhasil dibuat');
    }

    public function restore(Request $request)
    {
        set_time_limit(0);

        $request->validate([
            'backup_file' => 'required|file'
        ]);

        $file = $request->file('backup_file');

        if ($file->getClientOriginalExtension() !== 'sql') {
            return back()->withErrors([
                'backup_file' => 'File harus berformat .sql'
            ]);
        }

        $filename = 'restore.sql';
        $file->move(storage_path('app/restore'), $filename);

        $db = config('database.connections.mysql');

        $mysql = 'D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe';
        $path = storage_path('app/restore/' . $filename);

        $command = "\"$mysql\" -u{$db['username']} {$db['database']} < \"$path\"";
        exec($command);

        LogAktivitas::add(
            'RESTORE_DATABASE',
            'Merestore database dari file: ' . $file->getClientOriginalName(),
            'backup_restore',
            null
        );

        return back()->with('success', 'Database berhasil direstore');
    }
}
