---
title: Proxy issues
taxonomy:
    category: docs
---

Running GPM commands behind a proxy might result in an error.

cURL allows you to set the proxy as an environment variable (`http_proxy` and `https_proxy`), without changes needed in Grav.

See [http://stackoverflow.com/questions/7559103/how-to-setup-curl-to-permanently-use-a-proxy](http://stackoverflow.com/questions/7559103/how-to-setup-curl-to-permanently-use-a-proxy)

But first, if your environment has `fopen` enabled, you need to turn it off by disabling `allow_url_fopen` via php.ini.

This is because if `fopen` is available, Grav automatically uses that over `curl`.