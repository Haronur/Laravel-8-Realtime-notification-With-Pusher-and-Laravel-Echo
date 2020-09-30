<template>
    <div class="wrap">
        <a :href="threadUrl">
            {{ unread.data.user.name }} commented on {{ unread.data.CommentDetails.body }}
        </a>
    </div>
</template>

<script>
    export default {
        props:['unread'],
        data(){
            return {
                threadUrl:""
            }
        },
        mounted(){
            this.threadUrl="CommentDetails/"+ this.unread.data.CommentDetails.id
        }

    }
</script>
