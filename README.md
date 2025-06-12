# VodaNew

This repository hosts a collection of PHP and Node.js scripts designed for automating
web requests to several online gaming platforms (e.g., gameplay.mzansigames.club,
yellorush.co.za, wozagames.com). The scripts work together to generate request
headers, manage cookies, and submit scores.

## Key Components

- **Tools.php / Tools-mtn.php / Tools-telkom-v2.php**  
  Helper libraries to scrape leaderboard positions, choose target scores, and craft
  HTTP requests with custom headers or random user agents.

- **xavi*.php**  
  Scripts that assemble scores and call the helper functions to send game requests.
  Different variants (xavi.php, xavi-mtn.php, xavi-telkom.php, etc.) support various
  network providers.

- **requests-*.php**  
  Wrapper scripts that use the Zebra_CURL library for concurrency.  
  For example, `requests-voda2.php` loads a pool of cookies from `cookies.json`,
  locks them while in use, and fires multiple `xavi.php` requests in parallel.

- **cookies.json**  
  Stores cookie strings with an `isFree` flag so multiple runs can share cookies
  without conflicts.

- **app.js**  
  A small Express server that returns encrypted “X-CHAVI” tokens needed by the game
  endpoints.

## Usage

The `xavi` scripts combine with the `requests-*` wrappers to automate score
submissions. Cookies are pulled from `cookies.json`, locked during execution, and
released afterward. Zebra_CURL handles concurrency for faster batch requests.

These tools demonstrate automated HTTP requests, cookie management, and concurrent
processing. Use them responsibly and only for legitimate testing or learning
purposes.
