SPAM

I'm terrified about spam. How do we help reduce the chance of that?

First - try and reduce a lot of the structural SMTP problems that have made spamming economically and technically viable - 

Messaging is the *sender's* responsibility in terms of retransmissions, crypto calculatoins.

Sender endpoints are positiveily identified using public-key cryptography, digital signatures, and checksums.

If a sender cannot connect to a reciever, it is the *sender's* responsibility to re-transmit - following an exponential back-off algorithm or possibly just giving up immediately and informing the end-user (probably more desired nowadays)