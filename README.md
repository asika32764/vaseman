# Windwalker Starter

![logo](https://user-images.githubusercontent.com/1639206/122663390-a5cad880-d1cc-11eb-9592-33e507f2099f.png)

This is [Windwlaker Framework](https://github.com/ventoviro/windwalker-framework) starter package.

## Installation Via Composer

``` bash
composer create-project windwalker/starter windwalker ^4.0 --remove-vcs
```

## Getting Started

Open `http://{Your project root}/www`, you will see the sample page.

![home](https://user-images.githubusercontent.com/1639206/122663411-d4e14a00-d1cc-11eb-892d-f20c6f0e9eec.jpg)


Open `http://{Your project root}/www/dev.php`, you will enter the development mode.

## Using Console

Type this command in your terminal:

``` bash
php windwalker
```

You will see console usage:

```
Windwalker Console 4.x

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display help for the given command. When no command is given display help for the list command
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi|--no-ansi  Force (or disable --no-ansi) ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  dump-server      Start the dump server to collect dump information.
  help             Display help for a command
  list             List commands
  run              Run custom scripts.
  schedule         Run CRON schedule
 asset
  asset:version    Create assets version file.
 build
  build:entity     Build entity getters/setters and sync properties with database.
  build:form       Build form definition from DB table.
 cache
  cache:clear      Clear cache
 db
  db:export        Export database to file.
 generate
  generate:make    [g] Generate files.
  generate:revise  Revise file to template.
 mail
  mail:test        This command will send a test mail by your mail settings.
 mig
  mig:create       Create a migration version.
  mig:go           Migrate to specific version or latest.
  mig:reset        Reset migration versions.
  mig:status       Show migration status.
 pkg
  pkg:install      Install package resources.
 seed
  seed:clear       Clear seeders
  seed:create      Create a seeder.
  seed:import      Import seeders
```

### Import Sample Schema

``` bash
php windwalker mig:status
php windwalker mog:go --seed
```

## How To Use Windwalker

Please see [Documentation](http://windwalker.io/documentation/).
