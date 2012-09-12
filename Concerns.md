##SPAM

I'm terrified about spam. How do we help reduce the chance of that?

First - try and reduce a lot of the structural SMTP problems that have made spamming economically and technically viable - 

Messaging is the *sender's* responsibility in terms of retransmissions, crypto calculations.

Sender endpoints are positiveily identified using public-key cryptography, digital signatures, and checksums.

If a sender cannot connect to a reciever, it is the *sender's* responsibility to re-transmit - following an exponential back-off algorithm or possibly just giving up immediately and informing the end-user (probably more desired nowadays).

##CLIENT-LOAD
For a moderate Twitter user - I follow 100 some-odd people - the idea of my smartphone making (worst-case scenario) 100 connections to get status updates isn't too crazy. But for a hardcore twitter user - I know them - who follow 7,540 people, I can't imagine this solution to be correct.

It's partially mitigated by the fact that many of those same people will be on the same networks as eachother, so instead of 7540 requests, it might end up being something smaller - but still, in a worst-case (or perhaps best-case?) scenario, in which you're following that many people, and *each* one is hosted on its own server - you could easily be talking 7540 requests in order to generate a near-full feed for you.

##CLIENT-centric vs SERVER-centric
We could probably just add an 'aggregation protocol' to the spec - keep it optional for those weird hardcore folks, and call it a day. But once you have that spec defined, the temptation is for _everyone_ to use it (it'll be much easier to implement for the reader/poster app developers). And the problem with a system where you centralize the feed is that each of the federated systems ends up having to firehose to the others. Thus undoing a lot of the point of the thing.

The nice thing about Doing it with the Client bearing most of the load is it reduces the cost and complexity of being a service provider. The same amount of bandwidth (roughly) is going to go down to the phone or computer or whatever reader it may be. This way it goes more distributedly, from a whole bunch of different locations, rather one.

However - the problem comes back when you are following 7000 people. 7000 some-odd, even if every 10 of them are hosted all at the same place, is too many (then it would be 700. Still too many connections, no?).

I really don't want to give up on the idea that a single dude could host this himself, as mostly static files.

