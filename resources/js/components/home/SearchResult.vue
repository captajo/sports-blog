<template>
    <div>
        <div class="row">								 
            <div class="col-md-6" v-for="rec of otherPosts">
                <div class="feature_news_item">
                    <div class="item">
                        <div class="item_wrapper">
                            <div class="item_img">
                                <!-- <img class="img-responsive" v-if="rec.image" :src="rec.image" alt="Chania"> -->
                                <div v-if="rec.image" :style="'width: 100%; height: 255px; background-image: url('+rec.image+'); background-size: auto 100%;'"></div>
                                <img class="img-responsive" v-else src="/assets/img/category.jpg" alt="Chania">
                            </div><!--item_img--> 
                            <div class="item_title_date">
                                <div class="news_item_title">
                                    <h1><a :href="'/post/' + rec.slug">{{rec.title}}</a></h1>
                                </div><!--news_item_title-->
                                <div class="item_meta"><a :href="'/post/' + rec.slug">{{rec.updated_at}},</a> by:<a href="#">{{rec.author}}</a></div>
                            </div><!--item_title_date-->
                        </div><!--item_wrapper-->
                        <div class="item_content">{{rec.body}}</div><!--item_content-->

                    </div><!--item-->
                </div><!--feature_news_item-->
            </div><!--col-md-6-->
                                         
        </div><!--row-->
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['search'],

        data() {
            return {
                posts: [],
                featuredPosts: [],
                otherPosts: []
            }
        },

        mounted() {
            console.log(this.search);
            this.getPosts();
        },

        methods: {
            getPosts() {
                axios.get('/api/search/posts?search=' + this.search).then(resp => {
                    this.otherPosts = resp.data.data;
                });
            }
        }
    }
</script>
