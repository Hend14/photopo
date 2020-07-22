<template>
  <div>
    <button v-if="!liked" type="button" class="btn" @click="like(postId)"><i class="far fa-heart btn-like"></i> {{likeCount}}</button>
    <button v-else type="button" class="btn" @click="unlike(postId)"><i class="fas fa-heart btn-like"></i> {{likeCount}}</button>
  </div>
</template>

<script>
    export default {
      props: ['post', 'postId', 'userId', 'defaultLiked','defaultCount'],
      data() {
        return {
          liked: false,
          likeCount: null,
        };
      },
      created () {
        this.liked = this.defaultLiked
        this.likeCount = this.defaultCount
      },

        methods: {
          like(postId) {
            let url = `/api/posts/${postId}/like`
            axios.post(url, {
              user_id: this.userId,
            })
            .then(response => {
              this.liked = true
              this.likeCount = response.data.likeCount
            })
            .catch(error => {
              alert(error)
            });
          },
          unlike(postId) {
            let url = `/api/posts/${postId}/unlike`
            axios.post(url, {
              user_id: this.userId,
            })
            .then(response => {
              this.liked = false
              this.likeCount = response.data.likeCount
            })
            .catch(error => {
              alert(error)
            });
          }
        }
    }
</script>