<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MaintenanceController extends Controller
{
    private const COMMANDS = [
        'optimize_clear' => [
            'label' => 'Optimize Clear',
            'command' => 'optimize:clear',
            'description' => 'Clear cached config, route, view, event, and compiled files.',
        ],
        'migrate' => [
            'label' => 'Migrate',
            'command' => 'migrate',
            'description' => 'Run pending database migrations with --force.',
        ],
        'storage_link' => [
            'label' => 'Storage Link',
            'command' => 'storage:link',
            'description' => 'Create the public storage symlink.',
        ],
    ];

    public function index()
    {
        return view('maintenance.index', [
            'commands' => self::COMMANDS,
        ]);
    }

    public function run(Request $request)
    {
        $validated = $request->validate([
            'command' => 'required|string|in:' . implode(',', array_keys(self::COMMANDS)),
        ]);

        $selected = self::COMMANDS[$validated['command']];
        $parameters = $selected['command'] === 'migrate' ? ['--force' => true] : [];

        try {
            Artisan::call($selected['command'], $parameters);
            $output = trim(Artisan::output()) ?: 'Command completed without output.';

            return redirect()->route('admin.maintenance.index')
                ->with('success', $selected['label'] . ' completed successfully.')
                ->with('artisan_output', $output);
        } catch (\Throwable $e) {
            return redirect()->route('admin.maintenance.index')
                ->with('error', $selected['label'] . ' failed: ' . $e->getMessage())
                ->with('artisan_output', trim(Artisan::output()));
        }
    }
}
