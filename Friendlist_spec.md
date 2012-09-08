A user’s own friendlist will be hosted at the URL specified by the user’s ‘userinfo’ resource as in the User Spec profile.

The friendlist MAY require authentication to view, and MUST require authentication to modify. The authentication scheme should be provided by the HTTP/1.1 protocol employed - examples (non-normative) would be: HTTP Basic, HTTP Digest, or Cookie-based authentication.
a user’s friendlist can be appended to (adding a friend) by POST’ing content-type: application/json to the above friendlist URL. (note - should that be PUT instead to a particular ‘id’? No.)
a user’s friendlist can be deleted from (removing a friend) by DELETE’ing to the friendlist-url with the friend name or ID - e.g.
DELETE <user-url>/friendlist/abcdefghijklmnop
a friend-entry looks as follows:
```js
"someidnumber": {
	"url": "http://<some-domain-name>/someuser",
	"key": "abcdefghijklmnopqrstuvwxyzABCDEFG"
}
```

a friend-list is a collection of such key-hash pairs, such as:
```js
{
	"friend_id_1": {
		"url": "http://adomain.com/",
		"key": "whatever"
	},
	"friend_id_2": {
		"url": "http://someotherdomain/some/user/name",
		"key": "some_other_key"
	}
}
```