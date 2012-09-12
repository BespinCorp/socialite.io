A user’s own friendlist will be hosted at the URL specified by the user’s ‘userinfo’ resource as in the User Spec profile.

The friendlist MAY require authentication to view, and MUST require authentication to modify. The authentication scheme should be provided by the HTTP/1.1 protocol employed - examples (non-normative) would be: HTTP Basic, HTTP Digest, or Cookie-based authentication.

A user’s friendlist can be appended to (adding a friend) by POST’ing content-type: application/json to the above friendlist URL. (note - should that be PUT instead to a particular ‘id’? No.)

A user’s friendlist can be deleted from (removing a friend) by DELETE’ing to the friendlist-url with the friend name or ID - e.g.
```DELETE <user-url>/friendlist/abcdefghijklmnop```

a friend-entry looks similar to the User Spec, as follows:

```js
"http://<user-url>/something": {
	"feed": "<feed-URL>",
	"post": "<post-URL>"
}
```

Each friend entry might be specific to the requester - a different 'friend' might have a different friend-entry for the same person.

a friend-list is a collection of such key-hash pairs, such as:
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
	}
}
```

The 'key' is offered to the user (the 'reader') by the publisher (the 'sharer'). It is optional; if none is given, no key is required to access the friend's post data.

The 'proxies' element MAY be set for any feed-data that the server is convinced has the latest friend data. This may include the server itself, or an affiliated or third-party server (for whom access is authorized). If a server itself had retrieved a feed for the user and is sure that it is relatively recent, the client may retrieve from the proxy server instead. A proxy might have multiple disparate feeds for various different users. This could be useful for 'power-users' who follow large numbers of users (in excess of 1000?). In the case of the proxy feed, the Batch-fetch protcol (see the Feed spec) *MUST* be employed, and the client *MUST* collect together all friends on the friend-list which have the same proxy, and make one singular batch request for all of the feed data.

If a server wishes to encourage use of batch-fetch protocol for other friends' data, it should always list itself in the 'proxies' section.
