# Sign in With Clerk


A [Flarum](http://flarum.org) extension. Sign in with Clerk

## Installation

Install with composer:

```sh
composer require umhelper/oauth-clerk:"*"
```

## Updating

```sh
composer update umhelper/oauth-clerk
php flarum cache:clear
```

## Configuration

Once enabled, this extension will add a `Clerk` option to the settings page of `fof/oauth`. Toggle `Clerk` on, and hit the configure icon.

Follow the [Clerk documentation](https://api.clerk.com/authentication/sign-in-with-clerk)

You can use Postman to set up an OAuth application by sending the requests following the documentation.

It is **imperitive** that you grant the following scopes to your new application at Clerk:
- `email`
- `profile`

Set the callback URL as given in the extension settings.

Enter the `Client ID` and `Client Secret` as displayed in the `Basic Information` page at Clerk into the Flarum configuration.

Enjoy logging in with your Clerk credentials!

## Links

- [Packagist](https://packagist.org/packages/umhelper/oauth-clerk)
- [GitHub](https://github.com/UMHelper/flarum-ext-oauth-clerk/)
- [Discuss](https://discuss.flarum.org/d/33713-sign-in-with-clerk-oauth)
