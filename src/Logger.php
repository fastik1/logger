<?php

namespace Fastik1\Logger;

final class Logger
{
    private static string $path = 'logs';
    private static string $extension = '.log';
    private static string $dateFormat = 'd.m.Y H:i:s';

    public static function add(string $section, string $text, array $context = []): void
    {
        self::createIfNotExistsLogsDir();
        self::pushLogToFile(self::getFileName($section), self::generateLogContent($text, $context));
    }

    private static function pushLogToFile(string $path, string $content)
    {
        file_put_contents($path, $content, FILE_APPEND);
    }

    private static function generateLogContent(string $text, array $context = []): string
    {
        return "\n\n[" . date(self::$dateFormat) . "] $text" . (!empty($context) ? " | Context: " . self::contextToJson($context) : null);
    }

    private static function contextToJson(array $context): string
    {
        return json_encode($context, JSON_UNESCAPED_UNICODE);
    }

    private static function getFileName($section): string
    {
        return self::$path . '/' . $section . self::$extension;
    }

    private static function createIfNotExistsLogsDir(): void
    {
        if (!is_dir(static::$path)) {
            if (!mkdir(static::$path, recursive: true)) {
                throw new \Exception('Failed to create directory: ' . static::$path);
            }
        }
    }

    public static function getPath(): string
    {
        return self::$path;
    }

    public static function setPath(string $path): void
    {
        self::$path = $path;
    }

    public static function getExtension(): string
    {
        return self::$extension;
    }

    public static function setExtension(string $extension): void
    {
        self::$extension = $extension;
    }

    public static function getDateFormat(): string
    {
        return self::$dateFormat;
    }

    public static function setDateFormat(string $dateFormat): void
    {
        self::$dateFormat = $dateFormat;
    }
}