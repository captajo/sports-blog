<template>
    <div>
        <div class="category_layout" v-for="(rec, indx) in posts">
            <div :class="'item_caregory ' + (indx == 1 ? 'red' : indx == 2 ? 'blue' : 'teal')">
                <h2><a :href="'/category/' + rec.category.id">{{ rec.category.name }}</a></h2>
            </div>
                <div class="row" v-if="rec.posts.length > 0">
                        <div class="col-md-7">
                        <div class="item feature_news_item">
                            <div class="item_wrapper">
                                <div class="item_img">
                                    <img class="img-responsive" v-if="rec.posts[0].image" :src="rec.posts[0].image" alt="Chania">
                                    <img class="img-responsive" v-else src="/assets/img/img-single.jpg" alt="Chania">
                                </div><!--item_img--> 
                                <div class="item_title_date">
                                    <div class="news_item_title">
                                        <h2><a :href="'/post/' + rec.posts[0].slug">{{ rec.posts[0].title }}</a></h2>
                                    </div><!--news_item_title-->
                                    <div class="item_meta"><a :href="'/post/' + rec.posts[0].slug">{{ rec.posts[0].updated_at }},</a> by:<a href="#">{{ rec.posts[0].author }}</a></div>
                                </div><!--item_title_date-->
                            </div><!--item_wrapper-->	
                            <div class="item_content">{{ rec.posts[0].body }}</div><!--item_content-->

                        </div><!--feature_news_item-->
                        </div><!--col-md-7-->
                        
                        <div class="col-md-5">
                        <div class="media_wrapper">
                            <div class="media" v-if="rec.posts.length > 1">
                                <div class="media-left">
                                    <a :href="'/post/' + rec.posts[1].slug">
                                        <img class="media-object" v-if="rec.posts[1].image" :src="rec.posts[1].image" alt="Generic placeholder image">
                                        <img class="media-object" v-else src="/assets/img/img-single.jpg" alt="Generic placeholder image">
                                    </a>
                                </div><!--media-left-->
                                <div class="media-body">
                                    <h3 class="media-heading"><a :href="'/post/' + rec.posts[1].slug">{{rec.posts[1].title}}</a></h3>

                                    <p>{{rec.posts[1].body}}</p>

                                </div><!--media-body-->
                            </div><!--media-->

                            <div class="media" v-if="rec.posts.length > 2">
                                <div class="media-left">
                                    <a :href="'/post/' + rec.posts[2].slug">
                                        <img class="media-object" v-if="rec.posts[2].image" :src="rec.posts[2].image" alt="Generic placeholder image">
                                        <img class="media-object" v-else src="/assets/img/img-single.jpg" alt="Generic placeholder image">
                                    </a>
                                </div><!--media-left-->
                                <div class="media-body">
                                    <h3 class="media-heading"><a :href="'/post/' + rec.posts[2].slug">{{rec.posts[2].title}}</a></h3>

                                    <p>{{rec.posts[2].body}}</p>

                                </div><!--media-body-->
                            </div><!--media-->

                            <div class="media" v-if="rec.posts.length > 3">
                                <div class="media-left">
                                    <a :href="'/post/' + rec.posts[3].slug">
                                        <img class="media-object" v-if="rec.posts[3].image" :src="rec.posts[3].image" alt="Generic placeholder image">
                                        <img class="media-object" v-else src="/assets/img/img-single.jpg" alt="Generic placeholder image">
                                    </a>
                                </div><!--media-left-->
                                <div class="media-body">
                                    <h3 class="media-heading"><a :href="'/post/' + rec.posts[3].slug">{{rec.posts[3].title}}</a></h3>

                                    <p>{{rec.posts[3].body}}</p>

                                </div><!--media-body-->
                            </div><!--media-->

                            <div class="media" v-if="rec.posts.length > 4">
                                <div class="media-left">
                                    <a :href="'/post/' + rec.posts[4].slug">
                                        <img class="media-object" v-if="rec.posts[4].image" :src="rec.posts[4].image" alt="Generic placeholder image">
                                        <img class="media-object" v-else src="/assets/img/img-single.jpg" alt="Generic placeholder image">
                                    </a>
                                </div><!--media-left-->
                                <div class="media-body">
                                    <h3 class="media-heading"><a :href="'/post/' + rec.posts[4].slug">{{rec.posts[4].title}}</a></h3>

                                    <p>{{rec.posts[4].body}}</p>

                                </div><!--media-body-->
                            </div><!--media-->
                        </div><!--media_wrapper-->
                        
                        </div><!--col-md-5-->
                    </div><!--row-->
                </div><!--category_layout-->

    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [],

        data() {
            return {
                posts: []
            }
        },

        mounted() {
            this.getPosts();
            console.log(this.user);
        },

        methods: {
            getPosts() {
                axios.get('/api/category/posts').then(resp => {
                    this.posts = resp.data.data;
                });
            }
        }
    }
</script>
