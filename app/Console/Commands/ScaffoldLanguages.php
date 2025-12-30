<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ScaffoldLanguages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:scaffold {--translate : Whether to attempt automatic translation of missing keys} {--lang= : Specific language code to sync/translate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold and SYNCHRONIZE translation files for all configured languages based on English source';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $languages = config('languages');
        $sourcePath = resource_path('lang/en');
        $doTranslate = $this->option('translate');
        $targetLang = $this->option('lang');

        if ($targetLang) {
            if (!isset($languages[$targetLang])) {
                $this->error("Language {$targetLang} not found in config.");
                return 1;
            }
            $languages = [$targetLang => $languages[$targetLang]];
        }

        if (!File::exists($sourcePath)) {
            $this->error('English source directory not found!');
            return 1;
        }

        $files = File::files($sourcePath);

        foreach ($languages as $code => $details) {
            if ($code === 'en') {
                continue;
            }

            $targetPath = resource_path("lang/{$code}");

            if (!File::exists($targetPath)) {
                File::makeDirectory($targetPath, 0755, true);
                $this->info("Created directory for {$details['name']} ({$code})");
            }

            foreach ($files as $file) {
                $filename = $file->getFilename();
                $targetFile = "{$targetPath}/{$filename}";

                $sourceData = include $file->getPathname();
                $targetData = [];

                if (File::exists($targetFile)) {
                    $targetData = include $targetFile;
                    $this->line(" - Updating {$filename} in {$code}...");
                } else {
                    $this->line(" - Creating {$filename} in {$code}...");
                }

                $syncedData = $this->syncArrays($sourceData, $targetData, $code, $doTranslate);

                $content = "<?php\n\nreturn " . $this->var_export_pretty($syncedData) . ";\n";
                File::put($targetFile, $content);
            }
        }

        $this->info('Language synchronization completed!');
        return 0;
    }

    /**
     * Deep merge arrays while preserving existing values and optionally translating missing ones.
     */
    private function syncArrays($source, $target, $langCode, $translate = false)
    {
        if (!is_array($source)) {
            $this->error("Source is not an array for {$langCode}");
            return $target;
        }

        $result = is_array($target) ? $target : [];

        foreach ($source as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->syncArrays($value, $result[$key] ?? [], $langCode, $translate);
            } else {
                // If it doesn't exist, or is exactly the same as English, try translating
                if (!isset($result[$key]) || $result[$key] === $value) {
                    if ($translate && !empty($value) && is_string($value)) {
                        $this->line("      Translating: " . substr($value, 0, 30) . "...");
                        $translated = $this->autoTranslate($value, $langCode);
                        $result[$key] = $translated ?: $value;
                        if ($translated) {
                            $this->line("      [OK]");
                        }
                    } else {
                        $result[$key] = $value;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * A simple automatic translation helper using free web endpoints.
     * Note: This is for development/scaffolding automation.
     */
    private function autoTranslate($text, $targetLang)
    {
        if (is_numeric($text) || strlen($text) < 2)
            return $text;

        // Skip very long strings
        if (strlen($text) > 3000) {
            $this->warn("      [Skipping] Text too long (" . strlen($text) . " chars)");
            return null;
        }

        usleep(1000000); // 1s

        $retries = 5;
        while ($retries > 0) {
            try {
                $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=" . $targetLang . "&dt=t&q=" . urlencode($text);

                if (strlen($url) > 10000) {
                    $this->warn("      [Skipping] URL too long");
                    return null;
                }

                $cmd = "curl.exe -s -k -L -A \"Mozilla/5.0\" \"" . str_replace('"', '\"', $url) . "\"";
                $response = shell_exec($cmd);

                if (!$response) {
                    throw new \Exception("curl.exe failed to get response");
                }

                $body = json_decode($response);
                if ($body === null) {
                    if (strpos($response, "429") !== false) {
                        $this->warn("      [Rate Limited] Waiting 30 seconds...");
                        sleep(30);
                        $retries--;
                        continue;
                    }
                    throw new \Exception("Invalid JSON response from Google");
                }

                if (isset($body[0])) {
                    $full = "";
                    foreach ($body[0] as $part) {
                        if (isset($part[0])) {
                            $full .= $part[0];
                        }
                    }
                    return $full ?: null;
                }
            } catch (\Exception $e) {
                $this->error("      [Error] " . $e->getMessage());
                $this->warn("      Retrying in 5 seconds...");
                sleep(5);
                $retries--;
                continue;
            }
            $retries = 0;
        }

        return null;
    }

    /**
     * A cleaner var_export for PHP files.
     */
    private function var_export_pretty($data, $indent = "")
    {
        switch (gettype($data)) {
            case "array":
                $indexed = array_keys($data) === range(0, count($data) - 1);
                $r = [];
                foreach ($data as $key => $value) {
                    $r[] = "$indent    "
                        . ($indexed ? "" : $this->var_export_pretty($key) . " => ")
                        . $this->var_export_pretty($value, "$indent    ");
                }
                return "[\n" . implode(",\n", $r) . ",\n" . $indent . "]";
            case "boolean":
                return $data ? "true" : "false";
            case "integer":
            case "double":
                return $data;
            default:
                return "'" . addcslashes($data, "'\\") . "'";
        }
    }
}
