---
title: Caching & Performance
taxonomy:
    category: docs
---

Caching is an integral feature of Grav that has been baked in from the start.  The caching mechanism that Grav employs is the primary reason Grav is as fast as it is.  That said, there are some factors to take into account.  

## Caching Providers

Grav uses the established and well-respected [Doctrine Cache][docterinecache] library. This means that Grav supports any caching mechanism that Doctrine Cache supports.  This means that Grav supports:

* Auto (Default) - Finds the best option automatically

* File - Stores in cache files in the `cache/` folder

* [APC][apc]

* XCache - [http://xcache.lighttpd.net/]()

* Couchbase - [http://www.couchbase.com/]()

* Memcache - [http://php.net/manual/en/book.memcache.php]()

* Memcached - [http://memcached.org/]()

* MongoDB - [http://www.mongodb.org/]()

* Redis - [http://redis.io]()

* Riak - [http://basho.com/riak/]()

* WinCache - [http://www.iis.net/downloads/microsoft/wincache-extension]()

* ZendDataCache - [http://files.zend.com/help/Zend-Server/content/data_cache_component.htm]()


By default, Grav comes preconfigured to use the `auto` setting.  This will try **APC**, then **WinCache**, then **XCache**, and lastly **File**.  You can, of course, explicitly configure the cache in your `user/config/system.yaml` file, which could make things ever so slightly faster.

## Caching Options

There are actually **4 types** of caching happening in Grav.  They are:

1. YAML configuration caching into PHP.
2. Core Grav caching for page objects.
3. Twig caching of template files as PHP classes.
4. Image caching for media resources.

The YAML configuration caching is not configurable, and will always compile and cache the configuration into the `/cache` folder. Image caching is also always on, and stores its processed images in the `/images` folder.

Core Grav caching has the following configuration options as configured in your `user/config/system.yaml` file:

```
cache:
  enabled: true                        # Set to true to enable caching
  check:
    pages: true                        # Check to see if page has been modifying to flush the cache
  driver: auto                         # One of: auto|file|apc|xcache|memcache|memcached|wincache
  prefix: 'g'                          # Cache prefix string (prevents cache conflicts)
```

As you an see, the options are documented in the configuration file itself.  During development sometimes it is useful to disable caching to ensure you always have the latest page edits. 

>>>> NOTE: Deleting a page does not clear the cache as cache clears are based on folder-modified timestamps.

>>> TIP: You can easily force the cache to clear by just touching/saving a configuration file.

The `cache: check: pages:` option can provide some slight performance improvements, but this will cause Grav to not check for any page edits.  This is intended as a **Production-only** setting.

The Twig templating engine uses its own file based cache system, and there are a few options associated with it.

```
twig:
  cache: false                          # Set to true to enable twig caching
  debug: true                           # Enable Twig debug
  auto_reload: true                     # Refresh cache on changes
  autoescape: false                     # Autoescape Twig vars
```

For slight performance gains, you can disable the `debug` extension, and also disable `auto_reload` which performs a similar function to `cache: check: pages` as it will not look for changes in `.html.twig` files to trigger cache refreshes.

[docterinecache]: http://docs.doctrine-project.org/en/2.0.x/reference/caching.html
[apc]: http://php.net/manual/en/book.apc.php
