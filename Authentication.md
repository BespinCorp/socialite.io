User identity is defined by a key pair, a private and public key. The public key contents are made available to anyone who asks via the user_spec protocol.

Writable access to one's own friendlist MUST be authenticated (?)

Requests to another's friendlist MAY be authenticated. Authenticated and non-authenticated access may have different results.

Requests to another's feed SHOULD be authenticated. The feed MAY be available without authentication, or it MAY demand authentication for access.

POST's to any user's feed using the Posting_Spec.md MUST be authenticated.

---------------------

I'm nervous about this crypto stuff. If someone gets your private key, then you're screwed. If you change your keys - all your posts to someone else's feeds would be invalidated immediately. What then?

The OAuth2 model of tokens and stuff might not be a bad move, but it could also be a big giant pain in the butt.

-----------------------

OAuth provides authorization, but not really non-repdudiation or authentication.

Instead of offering up a public key that people could use to verify a signature, what if we offer up something where you can POST to a URL with the appropriate tokens and get a 'yay' or 'nay' as to whether it's authentic? It can internally be implemented via crypto - or anything else.

If someone wants to follow you, they should be able to do so without some kind of big magilla. You shouldn't have to interact (if you have a 'go ahead and follow me, bro' policy).

They (or their posting service, really) asks for a token with which to fetch your feed. They get it back. It's somehow tied to them.

You basically have the same problem as before: Something in the past _had_ happened. And you can only check whether or not something _is_ happening now. What if you want to see about something from the past? All you have is how-the-keys-look-now (or is the token valid now) - you can't say anything about _was_ this valid _then_.

You could do _another_ layer of singature stuff - where you have some trusted third-party sign something so as to indicate that they checked it and that it was valid at the time. But then who signs the signer? Still have the same issue.

SSL/TLS solves this by having some core signatures/keys in the keychain.