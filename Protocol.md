The protocol consists of three elements, and exension methods so that additional services may be built on top of them. However, these three elements comprise the basic, bare minimum, implementation.

These are the User Specification, which specifies what consts a 'user' of the service and API endpoints to contact them or read their posts, the Feed specification, a universal and extensible JSON format for said posts, and the Post specification, a method of making public or private posts to another user.

#User Specification:

A user is simply a URL that returns an HTML or XML document with a particular ```<link>``` element.

A user-URL may be a 'vanity domain' (http://uberbrady.com), or a piece of a service-provider’s domain-space (http://short-message-social-network.com/uberbrady)

The response document *must* contain a ```<link>``` tag with a link pointing to a JSON file, which may be on the same server or a different one.

```<link rel="socialite.io/user" href="http://someurl/path/somefile.js">```

The linked-to document is a JS file looks as follows:
```js
{
	"feed": "<feed-URL>",
	"post": "<post-URL>",
	"usernames": ["http://sldkfj/lkjsdf","http://slkdjf/laksjdf"],
}
```

The "username" element is required so that someone cannot illicitly associate a social feed to their own domain. The feed must claim ownership of the username for the feed to be considered valid. The username element is an array, so multiple usernames are permitted.

Additional information MAY be provided including user’s first and last names, company name, biography, etc. An appendix of specified elements will be provided in this document. Non-standard elements MAY be include using a prefix of “x-”.

##Other fields

The value in parentheses is the JSON element that corresponds to the given user data.

* Bio (```bio```)
* Photo (```photo```)
* Display Name (```display_name```)
* first name (```gn```)
* last name (```sn```)
* company name (```company```)
* colophon (```colophon```)
* Friends List (```friendlist```) - see the additional friendlist specification

#Feed Specification:

A user's Feed must be hosted at the Feed URL specified the User JSON as in the User Specification.

If a feed is considered 'private', authenticated access will be required to retrieve the feed contents. 

A feed is a JSON object of posts as follows:
```js
{
	"continuation-url": "http://<somedomain>/path/element/?nexttoken=abcdefg",
	"posts": [
		{
			"url": "http://fqdn.something.com/some_unique_identifer_for_this_server",
			"username": "http://<user-service-URL>",
			"time": "2012-09-03T01:00:12Z",
			"text": "I am eating a sandwich"
		},
		{
			"url": "http://fqdn.something.com/another_unique_id",
			"username": "http://<user-service-URL>",
			"time": "2012-09-03T00:00:13Z",
			"text": "I am going to eat a sandwich"
		}
	]
}
```

A feed contains one or more posts, each of which *MUST* be hosted at a child URL of the Feed-url, and associatable with only that one parent. The individual feed URL *MUST* be a strict prefix of the individual post URL. An example:

###Valid Feed
Feed URL: http://samplehost.net/username/posts.aspx
individual post URL: http://samplehost.net/username/posts.aspx?postid=1234
 - Individual post is a 'child' URL of the parent Feed URL, a POST URL can belong to one and only one username

###Invalid Feed
Feed URL: http://samplehost.net/username/
Individual post URL: http://samplehost.net/posts/2012/2/10/my-sample-post.json
 - Individual post cannot be determined to belong to any one particular user

###Possibly valid Feed?
Feed URL: http://samplehost.net/posts/
Individual post URL: http://samplehost.net/posts/my-post-name.json
 - If one and only one user may post to the above-listed /posts/ feed, the feed and its invidiaul post URL's are valid.

Each post entry must consist of at least a "url," "username," "time" and “text”, elements. Additional supported elements will be specified in the appendix. Extension elements must be prepended with “x-”. Unrecognized elements *SHOULD* be ignored.

URL's for each individual message must be unique, and a GET to that URL MUST retrieve the JSON blob for the message. The format would look like a subset of the Feed Specification above:

```js
{
	"url": "http://fqdn.something.com/another_unique_id",
	"username": "http://<user-service-URL>",
	"time": "2012-09-03T00:00:13Z",
	"text": "I am going to eat a sandwich"
}
```

URL's *MUST* be able to be associated to the user by prefix. E.g., :

##Feed Aggregation/Batch Fetch (optional)
(optional) A feed resource *MAY* return a 307 (temporary redirect) message if a client has made too many requests of the server. A feed resource MAY return this upon the first request. The client should take the provided location: url as a batch-fetch URL, and should assemble all usernames (other than the ones previously retrieved) into a JSON array, then POST that array to the given batch-fetch URL. The client *SHOULD* set a ‘limit’ as part of its request, but the server will set one if the client does not. (Should this be 300 status instead? It’s moving from GET to POST and all kinds of other things are happening.) If the feed resource does not support batch-fetch, it should never return this status.

If the client does not support the batch-fetch protocol, it will have to wait before retrying access for the resource.

If the server *ONLY* supports batch fetch (not recommended), the client would be unable to retrieve the resource.

Batch fetch JSON format:
```js
{
	"usernames": ["http://userthing.com/joe","http://userthing.com/jane","http://userthing.com/bob","http://userthing.com/bill","http://userthing.com/george"],
	"limit": 100
}
```

The response format is the same as for an individual feed, but multiple usernames would show up in the results.

The list of messages returned may not be the same list another user sees.

Requesting just the feed URL will return a subset of only the most recent messages. Any list of messages that is not complete MUST return a continuation url token that may be requested using GET to retrieve the next set of messages.

All available HTTP caching mechanisms *SHOULD* be used to reduce server-load, and prevent redundant transfer of data - e.g. Etags, If-Modified-Since, etc.

## Additional possibly fields in a Post

* url - post is regarding a particular link, specified in the "url" attribute
* image - URL for an image to be displayed
* reply - Post is a response to another
* repost - Post is a re-share of another post


#Posting Specification

The URL where a user can post public or private messages to another user is defined as in the User specification. If posting is not supported, the post entry might be missing or blank. If posting is restricted to particular users, the posting URL may require authenticated access.

The source IP address of the Post *MUST* be another internet-connected server, *not* an end-user IP address. This is an antispam provision. This means that servers *MAY* use blacklists such as the Spamhaus PBL to restrict access to other, internet-connected, servers.

A Post is a simple HTTP POST in formats recommended by the HTML4.01 and later specifications (either application/x-www-form-urlencoded, or multipart/form-data) message to the Posting URL:

```
POST /yoursite/something HTTP/1.1
Blah: blah
Blah-blah: blah
Content-Type: application/x-www-form-urlencoded

url=http://www.mysite.com/posts/a_post_about_you/12345&sender=http://www.mysite.com/myuser&channel=public
```

The URL parameter is the URL at which the contents of the message may be retrieved by the recipient. The sender parameter is a URL reference to the user-URL of the sender of the message as specifed in the User Specification. The recipient of the message may choose not to retrieve the original message for any reason. The recipient of the message *SHOULD* perform some basic sanity checking of the message to ensure it is not forged. A recommended sanity-check algorithm would be, at minimum:

Fetching the sender data. Check the post URL to ensure it is a 'child' URL to the sender's root feedlist.

Message transmission is designed to be a burdern upon the sender, not the recipient. If a sender is somehow determined to be 'spammy', or taken offline due to some other type of abuse, the recipient of the spam messages might not ever retrieve the original message contents, nor present them to the user. This is a feature.