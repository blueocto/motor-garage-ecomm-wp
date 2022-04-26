<?php
// Install this file as LocalValetDriver.php in your site root.

class LocalValetDriver extends WordPressValetDriver {
  const PUBLIC_DOMAIN = 'https://decimaltenths.co.uk/';

  public function serves($sitePath, $siteName, $uri) {
    $path = parse_url($uri, PHP_URL_PATH);

    if (
      !file_exists($sitePath . $path) &&
      preg_match('#\.(jpe?g|gif|png|svg|webp)$#i', $path) > 0
    ) {
      $location = self::PUBLIC_DOMAIN . $path;
      header("Location: $location", 302);
      exit;
    }

    return true;
  }
}
