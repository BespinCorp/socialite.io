A user is defined by a piece of URL-space that behaves in a particular way and returns a particular format of data.

A user-URL may be a ‘vanity domain’ (http://uberbrady.com), or a piece of a service-provider’s domain-space (http://socialite.io/uberbrady)

A user-URL must respond to GET requests to the URL <user-URL>+/userinfo (e.g., http://uberbrady.com/userinfo or http://socialite.io/uberbrady/userinfo) with JSON-formatted containing at least the elements as follows:
```js
{
	"feed": "<feed-URL>",
	"post": "<post-URL>",
	"friendlist": "<friendlist-URL>"
}
```
“publickey” is another important element - if this is not specified, the user will not be able to post messages to other people’s feeds. A user-URL SHOULD include publickey.
Additional information MAY be provided including user’s first and last names, company name, biography, etc. An appendix of specified elements will be provided in this document. Non-standard elements MAY be include using a prefix of “x-”.
