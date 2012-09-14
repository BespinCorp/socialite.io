a User (the 'sender') may Post a message to another user (the ‘recipient’) at the recipient’s post-URL, specified in the ‘userdata.’ The post-URL may be time-limited. If the ‘interactor’ already follows the recipient, he will have a key from the follow action, and *MUST* Post the message using that key.

Message must use the HTTP POST method, with a content-type of application/json. The message's source IP address MUST be the posting server (this helps reduce distributed denial of service attacks).

Both the sender and receiver have public and private keys. The private keys are not exposed, and the public key contents are displayed as specified in the User spec.

In the general case, the sender of the message is authenticated by signing his request with his/her private key, allowing others to check the signature using his/her public key retrievable using his user-data (see User_spec.md). The recipient *MUST* check the signature (and check that the recipient is one for whom messages should be received), and *MUST NOT* display the message if the signature does not match.

The signature is across the entire message envelope, and a hashed digest of the message body (concatenated with the recipient). So the signature and the message body hash must be recalculated for every recipient.

The recipient may accept the message by responding with an HTTP/1.1 200 status message, or rejection of the message for any reason with a status message of 403. A status code in the 500 series means that the sending server should retry later. An exponential backoff algorithm is recommended.

Message Post Format:
```js
{
	"url": "http://message_fetch/url",
	"channel": "follow-notification",
	"body-digest": "kdkflaksdfkasdflASDFASDF",
	"sender": "<URL?>",
	"recipient": "<recip-URL>",
	"signature": "sldkfj",
	"date": "2012-09-12T00:01:02"
}
```

The body-digest hash is defined as follows:
```BCRYPT(<recip-URL>\0message-contents)```

Bcrypt is chosen as the default hashing algorithm to deliberately cause a small technical cost to the message transmission - making spamming less cost-effective.

Predefined channels are: follow-notification, public, and private. Public and private are messages to the recipient user - public messages will be visible in the recipient's feed, private messages will not. Other channels may be treated differently. Non-standard extensions to the 'channel' may be used by prefacing them with "x-vendorname-extensionname". Messages received in non-standard channels may be accepted or rejected, and the reader implementation may choose how to display them.

Decrypting the 'signature' using the public key should result in the same as the following hash:

```SHA256(body-digest\0date\0recipient\0sender\0url)```

(Fields are concatenated in alphabetic order, with Ascii NUL characters in between).

If the signature is correct, and the reader wants to look at the contents of the message, it may fetch the url. After applying a digest function to the resulting message, it should match the 'digest' of the originally posted message.

Anti-Spam provisions: 

Forcing the sender to do the cryptography, and forcing the sender to hold on to the message (and continue hosting the message) are antispam provions.

Message post recipients may also employ a blacklist for poster's socialite.io addresses, sender's IP addresses.

A responsible publishing service provider *SHOULD* enforce some limits on public messaging of users who do not follower the sender.

------------------------------------------------

-Why not just post the stupid message contents and be done with it? Easy - message duplication. That seems yucky. It should live in one and only one place.-

-If the reader wants to check validity of the message, it may check the provisional signature. It will have to fetch the sender's information (as in the User_spec) in order to find the public key.-

-Arbitrary message channels other than 'public' and 'private' should be supported? Somehow?-

The protocol should probably make it so that Posts *ONLY* originate from another server, never directly from an end-user. Right? Maybe? I dunno.

A la IM2000 or whatever DJB called it, posted messages are the responsibility of the POSTER, not the recipient? Just post a ‘notification?’

Use the crazy crypto here? (We don’t use it anywhere else?!) When you @message someone, the message goes into *your* feed first. Then you sign a digest and post that digest to the post-url. As a response you should get a timestamp and signature, proving receipt of the mesage. The recipient gets - a message ID (A url?), your user ID, a timestamp, a message digest, and a signature. (NB - the message is small enough that you might as well just POST the whole damned thing instead of a ‘pointer’). The recipient *MAY* then retrieve the message (?) by ID. If he does, he *MUST* recalculate the digest, ensure it matches, retrieve the message, ensure the contents are the same, and check the signature against the public key. This is a spam-reduction measure.

The ‘sender’ must retry sending until the message is received, using exponential backoff as necessary.

Probably something about ‘message channel’ here? E.g., public something or private something. Or maybe just keep that out of the protocol spec and leave that as an implementation detail; just keep the alerting happening here.

I think I need to yank the public/private key stuff. Key management becomes a nightmare - you need to have a full key history, key repudiation is a nightmare, it’s impossible to ‘snapshot’ someone’s keys (you’d have to use some kind of third-party snapshotting service that ‘seemed’ legit). It’s just awful.
