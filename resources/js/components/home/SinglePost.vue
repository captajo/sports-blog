<template>
    <div class="single_content_layout">
        <div class="item feature_news_item">
            <div class="item_img">
                <img  class="img-responsive" v-if="post.image" :src="post.image" alt="Chania">
                <img  class="img-responsive" v-else src="/assets/img/img-single.jpg" alt="Chania">
            </div><!--item_img--> 
                <div class="item_wrapper">
                    <div class="news_item_title">
                        <h2><a href="#">{{ post.title }}</a></h2>
                    </div><!--news_item_title-->
                    <div class="item_meta"><a href="#">{{ post.updated_at }},</a> by:<a href="#">{{ post.author }}</a></div>

                        <div class="single_social_icon">
                            <a class="icons-sm fb-ic" href="#"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                            <!--Twitter-->
                            <a class="icons-sm tw-ic" href="#"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                            <!--Google +-->
                            <a class="icons-sm gplus-ic" href="#"><i class="fa fa-google-plus"></i><span>Google Plus</span></a>
                            <!--Linkedin-->
                            <a class="icons-sm li-ic" href="#"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>

                        </div> <!--social_icon1-->
                        <br>

                        <div class="">
                            {{ post.body }}
                        </div><!--item_content-->
                        <br>

                        <div class="category_list">
                            <a href="#">{{ post.category ? post.category.name : '' }}</a>
                        </div><!--category_list-->
                </div><!--item_wrapper-->	
        </div><!--feature_news_item-->


        <div class="ad">
            <img class="img-responsive" src="/assets/img/img-single-ad.jpg" alt="Chania">
        </div>

        <div class="readers_comment">
            <div class="single_media_title"><h2>Related Comments</h2></div>
            <div class="media" v-for="rec in post.comments">
                <div class="media-left">
                    <a href="#">
                        <img alt="64x64" class="media-object" data-src="/assets/img/img-author1.jpg"
                                src="/assets/img/img-author1.jpg" data-holder-rendered="true">
                    </a>
                </div>
                <div class="media-body">
                    <h2 class="media-heading">{{rec.author}}</h2>
                    {{ rec.comment }}
                    <!-- <div class="comment_article_social">
                        <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                    </div> -->
                </div>
            </div>
        </div><!--readers_comment-->

        <div class="add_a_comment">
            <div class="single_media_title"><h2>Add a Comment</h2></div>
            <div class="comment_form">
                <div v-if="user">
                    <div class="form-group comment">
                        <textarea v-model="commentForm.body" class="form-control" id="inputComment" placeholder="Comment"></textarea>
                    </div>
                    <small style="color: red;" v-if="error.body">{{error.body}}</small>
                    <div>
                    <button type="submit" v-on:click="createPostComment()" :disabled="isLoading" class="btn btn-submit red">{{isLoading ? 'loading ...' : 'Submit'}}</button>
                    </div>
                </div>
                <div v-else>Please <a href="/login" style="color: blue">Login</a> to comment on this post</div>
            </div><!--comment_form-->
        </div><!--add_a_comment-->
                    
    </div><!--single_content_layout-->
</template>

<script>
    import axios from 'axios';

    export default {
        props: [
            'slug',
            'user'
        ],

        data() {
            return {
                post: {},
                commentForm: {
                    post_id: '',
                    body: ''
                },
                error: {
                    body: ''
                },
                isLoading: false
            }
        },

        mounted() {
            this.getPostDetail();
            console.log(this.user);
        },

        methods: {
            getPostDetail() {
                axios.get('/api/user/posts/' + this.slug).then(resp => {
                    this.post = resp.data.data;
                    this.commentForm.post_id = this.post.id;
                });
            },

            createPostComment() {
                if (!this.commentForm.body) {
                    this.error.body = 'Please enter a comment to proceed';
                    return;
                }
                
                this.isLoading = true;

                this.commentForm.post_id = this.post.id;
                axios.post('/api/user/post/comments', this.commentForm).then(resp => {
                    this.isLoading = false;
                    if (resp.data.status == 'success') {
                        this.post.comments.push(resp.data.data);
                        this.commentForm.body = '';
                    }
                });
            }
        }
    }
</script>
