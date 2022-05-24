## RajWebConsulting

### YouTube to MP3 Converter and MP4 Downloader API extension.

##### This script is an extension for MP3 Converter Pro v3 from [RajWebConsulting](https://shop.rajwebconsulting.com/store/converter-scripts) and enables you to install Single/Multi Button and Widget APIs on multiple Domains and consuming the JSON API of the Main MP3 Converter Pro v3 installation, to have a SOLID infrastructure (Using File Caching and saving CPU ressources).

- Main Version requires a MP3 Converter Pro v3 License from [RajWebConsulting](https://shop.rajwebconsulting.com/store/converter-scripts)

```diff
> If you don't want to buy a MP3 Converter Pro License and use your own Server resources,
> then please consider using the ready to use Button and Widget APIs (Contains Ads) from my Main Sponsor.

@@ (You don't need to download this Script, if using his APIs.) @@
```

> #### Main Sponsor
> https://ytconvert.me


#### Donations

- Each Donation is helpful. Thank you so much for supporting me.

<a href="https://www.buymeacoffee.com/andre.h1984" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-yellow.png" alt="Buy Me A Coffee" height="41" width="174"></a>

#### Demo
- Please see a running DEMO on the domain of my Main Sponsor.


#### Installation
This package requires Nodejs version 16.15.0 or later (LTS) to build the app.

1. Download the zip file from Github.

2. install dependencies via yarn.

```bash
yarn install
```

3. rename the .env.example file to .env and edit the example variables
```env
APP_NAME="YouTube to MP3 APIs"
APP_DOMAIN="https://example.com" # Domain where you wantr to install this app
APP_API_URL="https://example.com" # Domain of the ajax.php. usually should be the same as the APP_DOMAIN

# Support for Popup Ads. (Will add Scripttag to body)
# Paste only the URL to external script here. Dont add full script tags.
APP_API_ADS=""
APP_SEARCH_ADS=""
``` 

4. Build for production
```bash
yarn build
yarn generate
```

5. Copy `.htaccess` and `ajax.php` files from `server` folder to `dist` folder
 and Add your MP3 Converter Pro v3 domain and YouTube Video Backend domain and API KEY in the `ajax.php`

```php
// Your MP3 Converter Pro v3 URL here
$baseUrl = 'https://example.com';
// Your YouTube Video Backend v3 URL and API KEY here
$backendUrl = 'http://backend.example.com';
// Generate an API Key in Backend Admin Panel and paste it here.
$backendApiKey = 'YOUR_API_KEY';
```

6. Set your Domain Working directory to `/dist` folder
