<template>
    <div>
        <div class="row">
            <div class="col-md-12 text-center" v-if="posts.length == 0">
                You have not created any post.
            </div>
            <div class="col-md-4" v-for="rec in posts">
                <div class="feature_news_item">
                    <div class="item">
                        <div class="item_wrapper">
                            <div class="item_img">
                                <div :style="'width: 100%; height: 255px; background-image: url('+rec.image+'); background-size: 100% auto;'"></div>
                                <!-- <img class="img-responsive" :src="rec.image" alt="Chania"> -->
                            </div><!--item_img--> 
                            <div class="item_title_date">
                                <div class="news_item_title">
                                    <h3><a :href="'/post/' + rec.slug">{{rec.title}}</a></h3>
                                </div><!--news_item_title-->
                                <div class="item_meta"><a :href="'/post/' + rec.slug">{{rec.updated_at}},</a> by:<a href="#">{{rec.author}}</a></div>
                            </div><!--item_title_date-->
                        </div><!--item_wrapper-->
                        <div class="item_content">{{rec.body}}  
                        </div><!--item_content-->

                    </div><!--item-->     
                    <div class="row">
                        <div class="col-md-4">
                            <a :href="'/post/' + rec.slug"><button class="btn btn-default">View</button></a>
                        </div>
                        <div class="col-md-4">
                            <a :href="'/dashboard/manage/post?id=' + rec.id"><button class="btn btn-default">Edit</button></a>
                        </div>
                        <div class="col-md-4">
                            <a v-on:click="deletePost(rec.id)"><button class="btn btn-default">Delete</button></a>
                        </div>
                    </div>  
                    <br>        			 
                </div><!--feature_news_item-->
                
            </div><!--col-xs-4-->

        </div><!--row-->
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                posts: []
            }
        },

        mounted() {
            console.log('Component mounted.');
            this.getUserPosts();
        },

        methods: {
            getUserPosts() {
                axios.get('/api/user/posts').then(resp => {
                    console.log(resp);
                    this.posts = resp.data.data;
                });
            },

            deletePost(id) {
                if (confirm("Kindly confirm you want to delete this post? ")) {
                    axios.delete('/api/user/posts/' + id).then(resp => {
                        if (resp.data.status == 'success') {
                            window.location.reload();
                        }
                    });
                }
            }
        }
    }
</script>
