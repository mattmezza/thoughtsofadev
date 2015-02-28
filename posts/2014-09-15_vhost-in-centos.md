{
  "title":"Create vhosts easily with Apache and CentOS 7",
  "author":"admin",
  "tags":[
    "CentOS",
    "Apache",
    "vhosts",
    "SysAdmin"
  ],
  "image":"http://www.fastserverhosting.com/web.jpg"
}
---:endmetadata:---

Recently I bought a new __VPS server__ and I had to migrate my websites hosted in my old VPS into the new one.

Since my new VPS should have had to be mainly a web server, I decided to power up a __CentOS 7__ _64bit_ linux distribution.

I installed a basic __LAMP__ stack and to reach the webserver I used a domain which I purchased some time ago.

After the installation of the packages needed I faced the problem of configuring __Apache__ `httpd`. At first I started looking around in the Internet tryna find a good and reliable (and free) panel to manage the typical process of a webserver.
I found several projects but after a quick try I decided to set up my Apache installation by configuring the plain text files directly.

The result is this script I've taken from the Internet.
######Thanks [@alexnogard1](https://twitter.com/alexnogard1, 'alexnogard's on Twitter') for sharing it  [here](http://alexnogard.com/bash-scripting-creation-de-vhosts-apache-httpd-automatises, 'Visit alexnogard's website').

<script src="https://gist.github.com/mattmezza/2e326ba2f1352a4b42b8.js?file=vhost.sh"></script>

As you can see, I improved this script by adding the possibility to create a `https` domain.
Less intuitive is the creation of a subdomain: to achieve this goal you can provide to the script the complete subdomain (_e.g. matt.site.tld_) as the first input and an empty second parameter (_you can literally just press enter when it asks you an alias name_).

I've tried to keep the configuration files as simple as possible. If there is the necessity to have some specific apache directives it is possible to edit directly the `*.conf` file into httpd configuration directory.

This script has become a __GitHub Gist__ which you can find [here](https://gist.github.com/mattmezza/2e326ba2f1352a4b42b8). Hope it could be useful for you.
