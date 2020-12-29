<template>
    <ul class="flex mt-4">
        <li class="w-3/12">
            <app-tweet-reply-action />
        </li>
        <li class="w-3/12">
            <app-tweet-retweet-action />
        </li>
        <li class="w-3/12">
            <app-tweet-like-action :tweet="tweet" />
        </li>
    </ul>
</template>

<script>
import AppTweetReplyAction from './AppTweetReplyAction';
import AppTweetRetweetAction from './AppTweetRetweetAction';
import AppTweetLikeAction from './AppTweetLikeAction';

export default {
    components: {
        AppTweetReplyAction,
        AppTweetRetweetAction,
        AppTweetLikeAction,
    },

    props: {
        tweet: {
            required: true,
            type: Object,
        },
    },
}
</script>
