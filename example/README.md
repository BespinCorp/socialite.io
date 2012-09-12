A very trivial implementation of a sample feed, and a sample userinfo. JSONP protocol is also implemented.

This is not complete by any means, and should not be taken as a reference implementation.

It doesn't yet support the Post protocol (which is not even finalized yet) nor does it implement the friendlist protocol.

It does not perform 'reader' functions yet. It's publish-only for now.

#To Use

Rename config.php-dist to config.php. Set a username and password. Change the $base_url to the URL at which you're hosting the scripts.

Make sure whatever user your app is running as (apache, nobody, _www, or something else) has write permissions to the directory in which the app lives.

This app has not been checked for security issues. It's just a proof-of-concept for testing.

