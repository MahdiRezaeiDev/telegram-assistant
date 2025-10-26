<?php
// Show web PHP version
echo "Web PHP version: " . PHP_VERSION . "<br>";

// Try to get CLI PHP version
$cliVersion = shell_exec('php -v 2>&1'); // 2>&1 ensures errors are captured
echo "<pre>CLI PHP version:\n" . htmlspecialchars($cliVersion) . "</pre>";
