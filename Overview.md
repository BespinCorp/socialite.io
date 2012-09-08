Protocols Overview/Definitions:
The protocol is designed to be highly decentralized, and distributed. Basic functionality should be specified but latitude should be available to provide variable, different implementations, so long as they all obey the core specification.

The bulk of all access is likely to be internet-connected devices like phones and tablets, with desktop computers being second (and probably diminishing over time, though never completely disappearing).

People are URL’s: http://twitter.com/uberbrady or http://uberbrady.com

The protocol is all built on top of HTTP/1.1. Clients should expect HTTP-style redirects (and follow them) and the like (HTTP Authentication challenges, too). ???Or, possibly, authentication challenges to present to the user (text/html content)?
‘Following’, graph-wise, is unidirectional. (Some servers MAY wish to only share information with bi-directional friends). OAuth might be a good thing to require here?

Server-load is the responsibility of the *publisher*.

For the purposes of these specs, we will refer to a ‘sharer’ who writes posts that other people read, a ‘follower’ who reads posts written by someone else, and an ‘interactor’ who @-messages or @-replies to a message.

The ‘sharer’s url will be ```<user-url>```.