A friend list is a JSON-format to specify socialite.io users, usually in the context of a list of 'friends' or 'people you follow.'

```js
{
	"http://friend_url_1": {
		"feed": "http://adomain.com/"
	},
	"http://friend_url_2": {
		"feed": "http://someotherdomain/some/user/name",
	},
	"http://friend_url_3": {
		"feed": "http://thirdguyproxied/something",
		"proxies": [
			"http://thisserver/some/url",
			"http://someotherserver/some_other_url.xyz"
		]
	},
	"http://friend_url_4": {},
}
```

The resulting object has keys which are User Info URL's as listed in the Protocol specification. The values for each key *MAY* include Authorization and/or Authentication tokens, proxy URL's, feed URL's, and/or post URL's. They also may include nothing at all.

For any user in the list which has a feed URL or post URL that is not on that server (implying that there is a third-party hosting that user's feed list), the feed URL *SHOULD* be enclosed. This can help when performing batch-fetch operations.

