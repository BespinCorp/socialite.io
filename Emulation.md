Here are examples of how to emulate various well-known social networks' functionality.

#Twitter
@-messaging would be implemented via the Posting spec. DM'ing would be also via the Posting spec, but would only work if both parties were following eachother. This could be determined by employing a following-key. Replies would be to particular messages in the 'href' attribute? Private messages would just not be visible on the post-er's feed (they would be excluded from the feed list for third parties.) The private message would only be visible from the recipient's account directly, not via second-parties.

Private accounts would be implemented by not having a publicly accesible feed, and giving potential followers their own following key. Only when the user (the sharer) approved the account (possibly by following-back) would the following key be activated. The feed would otherwise not be viewable publicly.

#Google+

The 'circles' functionality could be implemented by giving each follower their own key, and those follower's fetches would only return messages posted to that 'circle.'

#Facebook

Facebook is a very complex platform. 'Likes' to particular pieces of content would be posts with no textual content, and perhaps an extended attribute (x-like) being set. The 'ticker' would be a particular subset of posts (likes, game activity, replies), and the main timeline would be status updates and wall messages (implemented like @-messages in Twitter above). The FB 'messaging' functionality would be similar to the DM functionality above.

