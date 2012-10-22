Authorization/(Authentication?) Placeholder Specification

A-*-n is not yet fully defined. Here are some notes for it:

You need to authenticate/authorize to view 'private' feeds, as well as to publish posts to other people's feeds (or to them privately, aka "direct message").

We will *probably* go with some kind of OAuth solution here.

The primary form of 'Authorization' will likely really be proving that you are, indeed, the user http://blah.com. So it's not even authorization, it's more Authentication. Then granting permission for the user http://blah.com to post messages to recipient 'blah' can be more fully defined.

The endpoint for the authentication piece will likely be the Feed 'host' - not the individual feed. This way, you can batch-fetch a list of feeds, and just put authentication headers in the request - the recipient server will then know you are who you say you are, and can use its own security algorithms to determine whether or not you're authorized each feed that you've requested.

Though what about when you post? What if the POST url isn't on the same host as the feed URL? That's certainly a possibility, isn't it? Well, it's something we'll just have to account for I guess. Or maybe we'll have to force the POST URL to be the same as the feed URL (maybe differentiating via HTTP method - e.g. GET vs. POST)

