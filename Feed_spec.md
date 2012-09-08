Feed spec:
A user’s ‘feed’ of posts will be posted at the above-mentioned feed URL. A feed-URL *MAY* be publically accessible without authentication, it *MAY* be accessible using HTTP authentication of some sort (as above), and it *MUST* be accessible when requested along with a correct ‘key’ (later?)

A feed is a JSON object of posts as follows:
```Js
{
	continuation-url: “http://<somedomain>/path/element/?nexttoken=abcdefg”,
posts: [
	{
		“time”: “2012-09-03T01:00:12Z”,
		“text”: “I am eating a sandwich”
	},
	{
		“time”: “2012-09-03T00:00:13Z”,
		“text”: “I am going to eat a sandwich”
	}
]
}
```

Each entry must consist of at least a “time” and “text” element. Additional supported elements will be specified in the appendix. Extension elements must be prepended with “x-”. Unrecognized elements *SHOULD* be ignored.

(optional) A feed resource *MAY* return a 307 (temporary redirect) message if a client has made too many requests of the server. A feed resource may even return this upon the first request. The client should take the provided location: url as a batch-fetch URL, and should assemble all usernames (other than the ones previously retrieved) into a JSON array, then POST that array to the given batch-fetch URL. The client *SHOULD* set a ‘limit’ as part of its request, but the server will set one if the client does not. (Should this be 300 status instead? It’s moving from GET to POST and all kinds of other things are happening.) If the feed resource does not support batch-fetch, it should never return this status.

Batch fetch JSON format:
```js
{
	“usernames”: [“joe”,”jane”,”bob”,”bill”,”george”],
	“limit”: 100
}
```

The list of messages returned may not be the same list another user sees.

Requesting just the feed URL will return a subset of only the most recent messages. Any list of messages that is not complete MUST return a continuation url token that may be requested using GET to retrieve the next set of messages. The continuation token will be appended to the HTTP message with the header “X-Continuation-url:”

JSON-P protocol *MUST* be supported - a URL parameter of “...?callback=funcname” can be specified to wrap the entire response around a JSON-P style callback-wrapper.

All available HTTP caching mechanisms *SHOULD* be used to reduce server-load, and prevent redundant transfer of data - e.g. Etags, If-Modified-Since, etc.