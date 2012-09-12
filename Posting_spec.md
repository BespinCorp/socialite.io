a User (the ‘interactor’) may Post a message to another user (the ‘recipient’) at the recipient’s post-URL, specified in the ‘userdata.’ The post-URL may be time-limited. If the ‘interactor’ already follows the recipient, he will have a key from the follow action, and *MUST* Post the message using that key.
```<Need non-follower Post protocol>```
```<easy to extend to ‘private message’/DM/fb-message’ style interaction?>```
```<Need strong authentication. Need ‘interactor’ verification of some sort. Leave room for anonymous interaction>```
```<<<<HUGE PROBLEM: Data duplication. When I Post to someone else, I really am Posting to both myself and their feed. That’s shitty. Ideally, the post should go to *one* place, but be appropriately viewable by people viewing either the interactor or recipient’s feeds. How does this work?>>>>>```

The protocol should probably make it so that Posts *ONLY* originate from another server, never directly from an end-user. Right? Maybe? I dunno.

Message Post Format:
```js
{
	"url": "http://message_fetch/url",
	"digest": "kdkflaksdfkasdflASDFASDF",
	"sender": "<URL?>",
	"signature": "sldkfj",
	"date": "2012-09-12T00:01:02"
}
```

If the reader wants to check validity of the message, it may check the provisional signature. It will have to fetch the sender's information (as in the User_spec) in order to find the public key.

Decrypting the 'signature' using the public key should result in the same as the following hash:

```SHA256(date\0digest\0recipient\0sender\0url\0)```

(Fields are concatenated in alphabetic order, with Ascii NUL characters in between).

If the signature is correct, and the reader wants to look at the contents of the message, it may fetch the url. After applying a digest function to the resulting message, it should match the 'digest' of the originally posted message.

Anti-Spam provisions: 

Forcing the sender to do the cryptography, and forcing the sender to hold on to the message (and continue hosting the message) are antispam provions.

Message post recipients may also employ a blacklist for poster's socialite.io addresses, sender's IP addresses.



------------------------------------------------

A la IM2000 or whatever DJB called it, posted messages are the responsibility of the POSTER, not the recipient? Just post a ‘notification?’

Use the crazy crypto here? (We don’t use it anywhere else?!) When you @message someone, the message goes into *your* feed first. Then you sign a digest and post that digest to the post-url. As a response you should get a timestamp and signature, proving receipt of the mesage. The recipient gets - a message ID (A url?), your user ID, a timestamp, a message digest, and a signature. (NB - the message is small enough that you might as well just POST the whole damned thing instead of a ‘pointer’). The recipient *MAY* then retrieve the message (?) by ID. If he does, he *MUST* recalculate the digest, ensure it matches, retrieve the message, ensure the contents are the same, and check the signature against the public key. This is a spam-reduction measure.

The ‘sender’ must retry sending until the message is received, using exponential backoff as necessary.

Probably something about ‘message channel’ here? E.g., public something or private something. Or maybe just keep that out of the protocol spec and leave that as an implementation detail; just keep the alerting happening here.

I think I need to yank the public/private key stuff. Key management becomes a nightmare - you need to have a full key history, key repudiation is a nightmare, it’s impossible to ‘snapshot’ someone’s keys (you’d have to use some kind of third-party snapshotting service that ‘seemed’ legit). It’s just awful.
