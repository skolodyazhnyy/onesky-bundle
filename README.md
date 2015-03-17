# OneSky integration Symfony Bundle

## Installation

1. Add bundle to your composer requirements

```bash
php composer.phar require skolodyazhnyy/onesky-bundle
```

2. Add bundle to your application kernel (`app/AppKernel.php`)

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Seven\Bundle\OneskyBundle\SevenOneskyBundle(),
        );

```

3. Configure OneSky API, add following configuration to your `app/config/config.yml`

```yaml
seven_onesky:
    api_key: %onesky_api_key%
    secret:  %onesky_secret%
    project: %onesky_project%
    # Configure mappings to match your needs, every mapping includes,
    #    sources - list of files to export, all by default
    #    locales - list of locales to export, all by default
    #    output - output filename pattern, you can use [filename], [locale], [extension] and [dirname] as parameters
    mappings:
        - { sources: ["messages.xliff"], locales: ["en", "es"], output: "%kernel.root_dir%/Resources/translations/messages.[locale].xliff" }
```

## Usage

Simply run `onesky:dump` command to dump all your location files to desired destination,
```bash
app/console onesky:dump
```

You are free to keep your translations under version control system or outside.

### Usage with capifony

If you are using capifony you can setup a task to update translations on remote server, simply add these task to your `app/deploy.rb`:

```ruby
namespace :onesky do
  desc "Dumps all translations from OneSky"
  task :dump, :roles => :app, :except => { :no_release => true } do
    capifony_pretty_print "--> Dumping all translations"

    run "#{try_sudo} sh -c 'cd #{latest_release} && #{php_bin} #{symfony_console} onesky:dump #{console_options}'"
    capifony_puts_ok
  end
end
```

And then run it, using

```bash
cap onesky:dump
```
