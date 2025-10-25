<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['vapi_token'] = getenv('VAPI_TOKEN') ?: 'changeme';

// Optional: If later integrating directly with vapi.ai
$config['vapi_base_url'] = getenv('VAPI_BASE_URL') ?: 'https://api.vapi.ai';
$config['vapi_api_key'] = getenv('VAPI_API_KEY') ?: null;
