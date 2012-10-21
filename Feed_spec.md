A user’s ‘feed’ of posts will be posted at the above-mentioned feed URL listed in the user's userinfo. A feed-URL *MAY* be publically accessible without authentication, it *MAY* be accessible using HTTP authentication of some sort (as above), and it *MUST* be accessible when requested along with a correct ‘key’ (later?)

A feed must also be available via JSON-P, if not at the original URL for the feed, then at an separate URL as listed in the 'userinfo' spec.

A feed is a JSON object of posts as follows:
```js
{
	"continuation-url": "http://<somedomain>/path/element/?nexttoken=abcdefg",
	"posts": [
		{
			"url": "some_unique_identifer_for_this_server",
			"username": "http://<user-service-URL>",
			"time": "2012-09-03T01:00:12Z",
			"text": "I am eating a sandwich"
		},
		{
			"url": "another_unique_id",
			"username": "http://<user-service-URL>",
			"time": "2012-09-03T00:00:13Z",
			"text": "I am going to eat a sandwich"
		}
	]
}
```

Each entry must consist of at least a "username," "time" and “text”, and "url" elements. Additional supported elements will be specified in the appendix. Extension elements must be prepended with “x-”. Unrecognized elements *SHOULD* be ignored.

URL's for each individual message must be unique, and a GET to that URL should retrieve the JSON blob for the message:

```js
{
	"url": "another_unique_id",
	"username": "http://<user-service-URL>",
	"time": "2012-09-03T00:00:13Z",
	"text": "I am going to eat a sandwich"
}
```

(optional) A feed resource *MAY* return a 307 (temporary redirect) message if a client has made too many requests of the server. A feed resource SHOULD NOT return this upon the first request. The client should take the provided location: url as a batch-fetch URL, and should assemble all usernames (other than the ones previously retrieved) into a JSON array, then POST that array to the given batch-fetch URL. The client *SHOULD* set a ‘limit’ as part of its request, but the server will set one if the client does not. (Should this be 300 status instead? It’s moving from GET to POST and all kinds of other things are happening.) If the feed resource does not support batch-fetch, it should never return this status.

If the client does not support the batch-fetch protocol, it will have to wait before retrying access for the resource.

If the server *ONLY* supports batch fetch (not recommended), the client would be unable to retrieve the resource.

Batch fetch JSON format:
```js
{
	"usernames": ["joe","jane","bob","bill","george"],
	"limit": 100
}
```

The response format is the same as for an individual feed.

The list of messages returned may not be the same list another user sees.

Requesting just the feed URL will return a subset of only the most recent messages. Any list of messages that is not complete MUST return a continuation url token that may be requested using GET to retrieve the next set of messages.

All available HTTP caching mechanisms *SHOULD* be used to reduce server-load, and prevent redundant transfer of data - e.g. Etags, If-Modified-Since, etc.

## Additional possibly fields in a Post

* url - post is regarding a particular link, specified in the "url" attribute
* image - URL for an image to be displayed
* reply - Post is a response to another
* repost - Post is a re-share of another post
