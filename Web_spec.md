“follow me” “message me” “view my profile” spec(s):
In an ideal world - URI protocol spec would be used here - “soc:profile:http://lkjlkjlkjlkjlkjsdfa”, “soc:follow:http://lkasdjfalksdjflaksdj” soc:post:http://lakjdfalskdjfalkdjf”

But that won’t work right now. At all. What about...

<object type=”x-socialite-io/socialstuff” data=”soc:profile:http://lskdjflskdjflksdjf”>
<iframe src=’’>
</iframe>
</object>

or perhaps something simpler - 

<a href='http://socialite.io/follow/http://desk.nu/test_user'
data-poofiddle='fribblefrotz'>Follow Me!</a>

maybe with an optional <script src=’http://socialite.io/something.js’> that makes that linkie thing more cool?