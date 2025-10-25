<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('vapi_parse_duration_to_seconds')) {
    /**
     * Parse a duration value into seconds.
     * Accepts:
     * - integer/float: treated as seconds
     * - string "HH:MM:SS" or "MM:SS" or "SS"
     * - arrays/objects with common keys (durationSeconds, duration, seconds, duration_ms, durationMs)
     */
    function vapi_parse_duration_to_seconds($value)
    {
        if ($value === null) {
            return 0;
        }
        // If it's an array/object with typical duration keys
        if (is_array($value) || is_object($value)) {
            $container = (array)$value;
            $candidates = ['durationSeconds', 'duration_sec', 'seconds', 'duration', 'conversationDurationSeconds', 'duration_s'];
            foreach ($candidates as $key) {
                if (isset($container[$key]) && is_numeric($container[$key])) {
                    return (int)round((float)$container[$key]);
                }
            }
            // Milliseconds variants
            $msCandidates = ['duration_ms', 'durationMs', 'conversationDurationMs'];
            foreach ($msCandidates as $key) {
                if (isset($container[$key]) && is_numeric($container[$key])) {
                    return (int)round(((float)$container[$key]) / 1000.0);
                }
            }
            // String variant embedded
            foreach (['duration_str', 'durationText', 'durationString'] as $key) {
                if (isset($container[$key]) && is_string($container[$key])) {
                    return vapi_parse_duration_to_seconds($container[$key]);
                }
            }
            return 0;
        }

        // Numeric seconds
        if (is_int($value)) {
            return $value;
        }
        if (is_float($value)) {
            return (int)round($value);
        }

        // HH:MM:SS or MM:SS or SS
        if (is_string($value)) {
            $trimmed = trim($value);
            if ($trimmed === '') { return 0; }
            if (preg_match('/^\d+$/', $trimmed)) {
                return (int)$trimmed;
            }
            $parts = explode(':', $trimmed);
            $parts = array_map('trim', $parts);
            $count = count($parts);
            if ($count === 3) {
                list($h, $m, $s) = $parts;
                return ((int)$h) * 3600 + ((int)$m) * 60 + (int)$s;
            }
            if ($count === 2) {
                list($m, $s) = $parts;
                return ((int)$m) * 60 + (int)$s;
            }
        }
        return 0;
    }
}

if (!function_exists('vapi_sum_minutes')) {
    /**
     * Calculate minutes from a list of durations or call objects.
     *
     * @param array $items List of seconds, duration strings, or call objects
     * @param string $rounding One of: 'ceil_each' (default), 'ceil_total', 'floor_total', 'round_total', 'exact'
     * @return array { total_seconds, total_minutes, billable_minutes, per_call_minutes }
     */
    function vapi_sum_minutes(array $items, $rounding = 'ceil_each')
    {
        $secondsList = [];
        foreach ($items as $item) {
            $secondsList[] = max(0, (int)vapi_parse_duration_to_seconds($item));
        }

        $totalSeconds = array_sum($secondsList);
        $totalMinutes = $totalSeconds / 60.0;

        $perCallMinutes = [];
        switch ($rounding) {
            case 'ceil_each':
                foreach ($secondsList as $sec) {
                    $perCallMinutes[] = (int)ceil($sec / 60.0);
                }
                $billableMinutes = array_sum($perCallMinutes);
                break;
            case 'ceil_total':
                $billableMinutes = (int)ceil($totalSeconds / 60.0);
                break;
            case 'floor_total':
                $billableMinutes = (int)floor($totalSeconds / 60.0);
                break;
            case 'round_total':
                $billableMinutes = (int)round($totalSeconds / 60.0);
                break;
            case 'exact':
                // Return rounded total minutes as integer for compatibility
                $billableMinutes = (int)round($totalMinutes, 2);
                break;
            default:
                foreach ($secondsList as $sec) {
                    $perCallMinutes[] = (int)ceil($sec / 60.0);
                }
                $billableMinutes = array_sum($perCallMinutes);
                $rounding = 'ceil_each';
        }

        return [
            'total_seconds' => $totalSeconds,
            'total_minutes' => $totalMinutes,
            'billable_minutes' => $billableMinutes,
            'per_call_minutes' => $perCallMinutes,
        ];
    }
}
