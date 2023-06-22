## RajWebConsulting

### YouTube to MP3 Converter and MP4 Downloader API extension.

##### This script is an extension for MP3 Converter Pro v3 from [RajWebConsulting](https://shop.rajwebconsulting.com/store/converter-scripts) and enables you to install Single/Multi Button, Widget and Search APIs on multiple Domains and consuming the JSON API of the Main MP3 Converter Pro v3 (MCP) and YouTube Video Backend v3 installation, to have a SOLID infrastructure (by using File Caching and saving CPU ressources by avoid multiple MCP instances on same Server.).

- Main Version requires a MP3 Converter Pro v3 and YouTube Video Backend License v3 from [RajWebConsulting](https://shop.rajwebconsulting.com/store/converter-scripts)

> #### Main Sponsor
> https://ytconvert.me


#### Donations

- Each Donation is helpful. Thank you so much for supporting me.

<a href="https://www.buymeacoffee.com/andre.h1984" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-yellow.png" alt="Buy Me A Coffee" height="41" width="174"></a>

#### Demo
- Please see a running DEMO on the domain of my Main Sponsor.


#### Installation
This package requires Nodejs version 16.13.0 to build the app.

1. Download the zip file from Github.

2. install dependencies via npm.

```bash
npm install
```

3. rename the .env.example file to .env and edit the example variables
```env
# App name (Title)
APP_NAME="YouTube to MP3 APIs"

# Domain where you want to install this app
APP_DOMAIN=http://example.com

# Domain of MP3 Converter Pro v3
APP_API_URL=https://example.com

# Domain of YouTube Video Backend v3
APP_BACKEND_URL=https://backend.example.com

# API Key generated in YouTube Video Backend Admin Panel
APP_BACKEND_API_KEY=YOUR_API_KEY

# Support for Popup Ads. (Will add Script tag to body)
# Paste only the URL to external script here. Dont add full script tags.
APP_API_ADS="https://myAdCompany.com/script123" # leave it empty for no ads
APP_SEARCH_ADS="https://myAdCompany.com/script123" # leave it empty for no ads
``` 

4. Build for production
```bash
npm run build
npm run generate
```

5. Copy `.htaccess` file from `server` folder to `dist` folder

6. Set your Domain Working directory to `/dist` folder

---

If u getting CORS error then Modify MP3 Converter Pro

change in config/cors.php
```php
'paths' => ['sanctum/csrf-cookie'],
```

to

```php
'paths' => ['sanctum/csrf-cookie', 'api/*'],
```

remove from  app/Http/Controllers/ApiController.php

```php
Line 402: header('Access-Control-Allow-Origin: ' . $protocol . '://' . $referer);

Line 409: header('Access-Control-Allow-Origin: *');
```
