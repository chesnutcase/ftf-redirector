# ftf-redirector

![](http://b.thumbs.redditmedia.com/AQ_47wQPWDOEuP0LohFeFYpoa3fdLcqWrgIxDYvU_PI.png)

Automatic redirector to the latest edition of Free Talk Fridays on the /r/anime subreddit

## Usage

Go to [ftf.chesnot.moe](http://ftf.chesnot.moe). Add:

- ```/s``` or ```/skip``` to skip the counter and get redirected via HTTP headers
- ```/debug``` to load the page with the counter set to 9001.

## Self-hosting

### Requirements

- LAMP stack
- [composer](https://getcomposer.org/)
- Access to cron
- Project root must have the permissions granted by apache to rewrite URLs

### Installation Steps

If you want to host this on your on site,

- Clone this repository to your web server
- Run ```composer install```
- Ensure you AllowOverrides in the project directory and allow URL rewrites
- Add ```php /path/to/cronjob.php``` to your crontab. (Currently, my cron install script is not working)
- You can set the fetch interval to any internal. Mine is set to 15 minutes.
- Ensure apache can write to that directory to store the data.

## Contributing

Open a pull request. I suck at CSS and if you can make the landing page prettier I would be really happy.

Also, my ```cron-init.sh``` is not working and I don't know why. If you know how to fix it, please do.

## Credits

The [/r/anime](https://reddit.com/r/anime) subreddit for existing

This project uses the [GuzzleHttp](http://docs.guzzlephp.org/en/stable/) PHP library.
