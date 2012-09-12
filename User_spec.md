A user is simply a URL that returns an HTML or XML document with a particular ```<link>``` element.

A user-URL may be a 'vanity domain' (http://uberbrady.com), or a piece of a service-provider’s domain-space (http://socialite.io/uberbrady)

The response document must contain a ```<link>``` tag with a link pointing to a JSON file.

```<link rel="socialite.io" href="http://someurl/path/somefile.js">```

The linked-to document is a JS file looks as follows:
```js
{
	"feed": "<feed-URL>",
	"post": "<post-URL>",
	"friendlist": "friendlist-URL",
	"username": "http://sldkfj/lkjsdf",
	"username": "http://slkdjf/laksjdf",
	"publickey": "baclkjsdflkasflkasjdgasldkjfalsdkfjaslfghasdvnzxasdlkfjwelrkjadf"
}
```

If a feed is private, authenticated access will be required to retrieve the feed contents. If posting is not supported, the post entry might be missing or blank.

The "username" elements are required so that someone cannot illicitly associate a social feed to their own domain. The feed must claim ownership of the username for the feed to be considered valid. Multiple usernames are permitted, with multiple meta tags.

"publickey" is another important element - if this is not specified, the user will not be able to post messages to other people’s feeds. A user-URL SHOULD include publickey.

Additional information MAY be provided including user’s first and last names, company name, biography, etc. An appendix of specified elements will be provided in this document. Non-standard elements MAY be include using a prefix of “x-”.

##Other fields

* Bio
* Photo
* Display Name
* first name
* last name
* company name
* colophon