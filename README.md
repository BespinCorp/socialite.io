Note that due to the modularity of the specifications, a 'publisher' might not be the same as a 'reader'. You could publish using one software stack, and read messages using another.

Start with the Protocol Overview.

The User Spec will probably be the first thing you'll have to work with to build a reader or publisher app.

The Friendlist spec will be necessary for readers, and will have some key information necessary for publishers.

The Feed Spec is the primary way of accessing a user's feed. Aggregating together various feeds for your various friends will be the primary way to display 'friend activity.'

The Posting spec will probably be the most complicated - it's basically a send/receive protocol. This will allow you to post to other people's feeds, and (depending on your social networking provider) possibly your own.