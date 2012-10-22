The specification is designed to be the bare minimum required to enable wire-compatible social network interoperation. It is a specification of (mostly) server-to-server interactions. As such, many features are left unspecified.

The main features are: the user specification, the feed specification, and the post specification. They are all listed in the main protocol document: [Protocol.md](Protocol.md)

Additionally, we define an optional file format for a [friendlist] (Friendlist_spec.md) which may be used as a native representation of a 'frends/followers list' or as an export/import/backup format for specifying one's own social network.

We also define an optional "[Web Specification](Web_spec.md)" for a unified way of presenting Socialite.io protocol-compatible users to the end-user when viewing a web page.

The next, and probably the most important, part of the protocol is the Authorization/Authentication part - and that's listed in the [A-star-n document](A-star-n.md).