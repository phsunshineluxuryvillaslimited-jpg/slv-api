<?php

return [
    'endpoint' => env('CLAUDE_ENDPOINT', 'https://api.anthropic.com/v1/complete'),
    'model' => env('CLAUDE_MODEL', 'claude-2.1'),
    'timeout' => env('CLAUDE_TIMEOUT', 30),
    'max_tokens' => env('CLAUDE_MAX_TOKENS', 300),
];
