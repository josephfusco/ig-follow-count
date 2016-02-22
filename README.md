# IG Follow Count

[![License](https://img.shields.io/badge/license-GPL--2.0%2B-green.svg)](http://www.gnu.org/licenses/gpl-2.0.html)

A simple Instagram analytics tool that continuously logs and graphs your follower count.

![screenshot of follower graph](https://cloud.githubusercontent.com/assets/6676674/13220190/ca183a80-d942-11e5-82e8-673bdb7b6604.png)

## Setup

Clone project into the public root of your web server.

```sh
git clone https://github.com/josephfusco/ig-follow-count
```

Copy `config-sample.php` to `config.php` in the project root and fill in the values.

```php
/** Instagram user ID */
define( 'IG_USER_ID', '' );

/** Instagram access token */
define( 'IG_ACCESS_TOKEN', '' );
```

SSH into server and Set the cron job.

```sh
crontab -e
```

In this example we are running `cron.php` every minute. Add the following to the file and save. (replace 'yourwebsite.com' with your domain)

```sh
*/1 * * * * wget -O /dev/null http://yourwebsite.com/cron.php
```

Upon saving the file it should confirm with the following message: `crontab: installing new crontab`.

Sample data will keep being displayed until `cron.php` is first ran. Once ran it will initially create the `log.csv` file and the sample data will stop loading.

## CSV Format

`Time,Grams,Followers,Following`

## Creators

**[Joseph Fusco](https://github.com/josephfusco)** & **[James Pistell](https://github.com/pistell)**
